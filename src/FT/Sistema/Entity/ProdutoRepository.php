<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 04/12/14
 * Time: 18:59
 */

namespace FT\Sistema\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use FT\Sistema\Uteis\Consts;

class ProdutoRepository extends EntityRepository
{
    public function getProdutos(Request $request)
    {
        //montando a consulta solicitada:
        $page = $request->get('page') ? $request->get('page') : Consts::PAGE;
        $offset = $request->get('offset') ? $request->get('offset') : Consts::OFFSET;

        $id = $request->get('id');
        $tid = $request->get('tid');
        $nome = $request->get('nome');
        $tnome = $request->get('tnome');
        $valor = $request->get('valor');
        $tvalor = $request->get('tvalor');
        $desc = $request->get('desc');
        $tdesc = $request->get('tdesc');

        //critérios referentes ao id
        $auxId = '';
        if(isset($id) && isset($tid)) {
            if ($tid == 'iga') {
                $auxId = '(p.id = :id)';
            } elseif ($tid == 'maq') {
                $auxId = '(p.id > :id)';
            } elseif ($tid == 'meq') {
                $auxId = '(p.id < :id)';
            }
        }

        //critérios referentes ao nome
        $auxNome = '';
        if(isset($nome) && isset($tnome)) {
            if($tnome == 'iga') {
                $auxNome = '(p.nome = :nome)';
            } elseif($tnome == 'ct') {
                $auxNome = '(p.nome LIKE :nome)';
            } elseif($tnome == 'nct') {
                $auxNome = '(p.nome NOT LIKE :nome)';
            }
        }

        //critérios referentes ao valor
        $auxValor = '';
        if(isset($valor) && isset($tvalor)) {
            if($tvalor == 'iga') {
                $auxValor = '(p.valor = :valor)';
            } elseif($tvalor == 'maq') {
                $auxValor = '(p.valor > :valor)';
            } elseif($tvalor == 'meq') {
                $auxValor = '(p.valor < :valor)';
            }
        }

        //critérios referentes à descrição
        $auxDesc = '';
        if(isset($desc) && isset($tdesc)) {
            if($tdesc == 'iga') {
                $auxDesc = '(p.descricao = :desc)';
            } elseif($tdesc == 'ct') {
                $auxDesc = '(p.descricao LIKE :desc)';
            } elseif($tdesc == 'nct') {
                $auxDesc = '(p.descricao NOT LIKE :desc)';
            }
        }

        //montando a dql correspondente à consulta solicitada
        $dql = '';
        $pid = false; //indica se deve setar o parâmetro id
        if($auxId <> '') {
            $dql .= $auxId;
            $pid = true;
        }

        $pnome = false; //indica se deve setar o parâmetro nome
        if($auxNome <> '') {
            if($dql <> '') $dql .= ' AND ';
            $dql .= $auxNome;
            $pnome = true;
        }

        $pvalor = false; //indica se deve setar o parâmetro valor
        if($auxValor <> '') {
            if($dql <> '') $dql .= ' AND ';
            $dql .= $auxValor;
            $pvalor = true;
        }

        $pdesc = false; //indica se deve setar o parâmetro descricao
        if($auxDesc <> '') {
            if($dql <> '') $dql .= ' AND ';
            $dql .= $auxDesc;
            $pdesc = true;
        }

        //completando a dql e criando a query
        if($dql == '') { //não há critérios de restriçao
            $dql = 'SELECT p FROM FT\Sistema\Entity\Produto p';
        }
        else { //há critérios de restrição e, portanto, cláusula Where
            $dql = 'SELECT p FROM FT\Sistema\Entity\Produto p WHERE '.$dql;
        }

        $query = $this->getEntityManager()->createQuery($dql);

        //setando os parâmetros usados
        if($pid) {
            $query->setParameter('id', $id);
        }

        if($pvalor) {
            $query->setParameter('valor', $valor);
        }

        if($pnome) {
            if($tnome == 'iga') {
                $query->setParameter('nome', $nome);
            }
            else {
                $query->setParameter('nome', '%'.$nome.'%');
            }
        }

        if($pdesc) {
            if($tdesc == 'iga') {
                $query->setParameter('desc', $desc);
            }
            else {
                $query->setParameter('desc', '%'.$desc.'%');
            }
        }

        //configurando a paginação
        $query->setFirstResult(($page-1)*$offset)->setMaxResults($offset);
        $paginator = new Paginator($query, $fetchJoinCollection = true);


        return [
            //'arrayProdutos' => $paginator->getIterator()->getArrayCopy(),
            'arrayProdutos' => $query->getResult(),
            'htmlPaginador' => $this->getHtmlPaginador($request, $page, $offset, $paginator->count())
        ];
    }

    public function getHtmlPaginador(Request $request, $pageCorrente, $offset, $totalRegistros)
    {
        //retorna um código html para o paginador
        $totalPaginas = ceil($totalRegistros / $offset);
        $pageInicial = intval(($pageCorrente-1)/Consts::PAGES)*Consts::PAGES+1;
        $pageFinal = min($pageInicial+Consts::PAGES-1, $totalPaginas);

        $queryStringModificada = str_replace("&offset=$offset", '', $request->getQueryString());
        $queryStringModificada = str_replace("offset=$offset", '', $queryStringModificada);
        $queryStringModificada = str_replace("&page=$pageCorrente", '', $queryStringModificada);
        $queryStringModificada = str_replace("page=$pageCorrente", '', $queryStringModificada);

        $url = 'http://'.$request->getHttpHost().$request->getPathInfo();

        if(empty($queryStringModificada)) {
            $url .= "?offset=".$offset."&page=";
        }  else {
            $url .= '?'.$queryStringModificada."&offset=".$offset."&page=";
        }

        //gerando o código html para o paginador...

        //página anterior:
        if($pageCorrente <= 1) {
            $result = '<ul><li class="disabled" title="Anterior"><span>«</span></li>';
        } else {
            $result = '<ul><li title="Anterior"><a href="'.$url.($pageCorrente-1).'">«</a></li>';
        }

        //páginas clicáveis
        for($i=$pageInicial; $i<=$pageFinal; $i++) {
            $class = ($i == $pageCorrente) ? 'active' : '';
            $result .= "<li class='$class' title='Página $i'><a href='".$url.($i)."'>$i</a></li>";
        }

        //próxima página:
        if($pageCorrente >= $totalPaginas) {
            $result .= '    <li class="disabled" title="Próxima"><span>»</span></li></ul>';
        } else {
            $result .= '    <li title="Próxima"><a href="'.$url.($pageCorrente+1).'">»</a></li></ul>';
        }

        //gerando a legenda para a lista de produtos
        $primeiro = $pageCorrente * $offset - $offset + 1;
        $ultimo = min($pageCorrente * $offset, $totalRegistros);
        if($primeiro > $totalRegistros || $primeiro < 1) {
            $legenda = "Intervalo não localizado";
        } else {
            $legenda = "Exibindo registros $primeiro a $ultimo de $totalRegistros";
        }

        return ['opcoes' => $result, 'legenda' => $legenda];
    }
} 