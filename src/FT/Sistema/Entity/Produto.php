<?php

namespace FT\Sistema\Entity;

use FT\Sistema\Interfaces\iProduto;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="FT\Sistema\Repository\ProdutoRepository")
 * @ORM\Table(name="produtos")
 */
class Produto implements iProduto
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\Column(type="float", scale=2)
     */
    private $valor;

    /**
     * @ORM\Column(type="text")
     */
    private $descricao;


    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function getValor()
    {
        //return $this->valor;
        return number_format($this->valor, 2);
    }

} 