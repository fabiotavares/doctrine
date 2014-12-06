<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 04/12/14
 * Time: 18:59
 */

namespace FT\Sistema\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;

class ProdutoRepository extends EntityRepository
{

    public function getFormConsulta(Request $criterios)
    {
        //critérios da consulta
        $id = $criterios->get('id');
        $tid = $criterios->get('tid');
        $nome = $criterios->get('nome');
        $tnome = $criterios->get('tnome');
        $valor = $criterios->get('valor');
        $tvalor = $criterios->get('tvalor');
        $desc = $criterios->get('desc');
        $tdesc = $criterios->get('tdesc');

        //montando a consulta solicitada
        $auxId = '';
        $auxNome = '';
        $auxValor = '';
        $auxDesc = '';
        $pid = false;
        $pnome = false;
        $pvalor = false;
        $pdesc = false;

        //critérios referentes ao id
        if(isset($id)) {
            if($tid == 'iguala') {
                //neste caso, deve-se ignorar o restante dos critérios
                return $this->findById($id);
            }
            elseif($tid == 'maiorque') {
                $auxId = '(p.id > :id)';
            }
            elseif($tid == 'menorque') {
                $auxId = '(p.id < :id)';
            }
        }

        //critérios referentes ao nome
        if(isset($nome)) {
            if($tnome == 'iguala') {
                $auxNome = '(p.nome = :nome)';
            } elseif($tnome == 'contem') {
                $auxNome = '(p.nome LIKE :nome)';
            } elseif($tnome == 'naocontem') {
                $auxNome = '(p.nome NOT LIKE :nome)';
            }
        }

        //critérios referentes ao valor
        if(isset($valor)) {
            if($tvalor == 'iguala') {
                $auxValor = '(p.valor = :valor)';
            } elseif($tvalor == 'maiorque') {
                $auxValor = '(p.valor > :valor)';
            } elseif($tvalor == 'menorque') {
                $auxValor = '(p.valor < :valor)';
            }
        }

        //critérios referentes à descrição
        if(isset($desc)) {
            if($tdesc == 'iguala') {
                $auxDesc = '(p.descricao = :desc)';
            } elseif($tdesc == 'contem') {
                $auxDesc = '(p.descricao LIKE :desc)';
            } elseif($tdesc == 'naocontem') {
                $auxDesc = '(p.descricao NOT LIKE :desc)';
            }
        }

        //unindo os critérios concatenando com and (se for o caso)
        $aux = '';
        if($auxId <> '') {
            $aux .= $auxId;
            $pid = true;
        }

        if($auxNome <> '') {
            if($aux <> '') $aux .= ' AND ';
            $aux .= $auxNome;
            $pnome = true;
        }

        if($auxValor <> '') {
            if($aux <> '') $aux .= ' AND ';
            $aux .= $auxValor;
            $pvalor = true;
        }

        if($auxDesc <> '') {
            if($aux <> '') $aux .= ' AND ';
            $aux .= $auxDesc;
            $pdesc = true;
        }

        //completando a consulta e criando a query
        $dql = 'SELECT p FROM FT\Sistema\Entity\Produto p';
        if($aux <> '') $dql .= ' WHERE '.$aux;
        $query = $this->getEntityManager()->createQuery($dql);

        //setando os parâmetros usados
        if($pid) {
            $query->setParameter('id', $id);
        }

        if($pvalor) {
            $query->setParameter('valor', $valor);
        }

        if($pnome) {
            if($tnome == 'iguala') {
                $query->setParameter('nome', $nome);
            }
            else {
                $query->setParameter('nome', '%'.$nome.'%');
            }
        }

        if($pdesc) {
            if($tdesc == 'iguala') {
                $query->setParameter('desc', $desc);
            }
            else {
                $query->setParameter('desc', '%'.$desc.'%');
            }
        }

        //retornando o valor da consulta
        return $query->getResult();
    }
} 