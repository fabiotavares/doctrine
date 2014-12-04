<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 06/11/14
 * Time: 18:52
 */

namespace FT\Sistema\Service;

use FT\Sistema\Entity\Produto;
use FT\Sistema\Mapper\ProdutoMapper;
use FT\Sistema\Interfaces\iProdutoService;
use Symfony\Component\HttpFoundation\Request;

class ProdutoService implements iProdutoService
{
    private $produto;
    private $produtoMapper;

    public function __construct(Produto $produto, ProdutoMapper $produtoMapper)
    {
        $this->produto = $produto;
        $this->produtoMapper = $produtoMapper;
    }

    public function fetchAll()
    {
        return $this->produtoMapper->fetchAll();
    }

    public function fetch($id)
    {
        return $this->produtoMapper->fetch($id);
    }

    public function delete($id)
    {
        return $this->produtoMapper->delete($id);
    }

    public function update(array $data)
    {
        $this->produto->setId($data['id']);
        $this->produto->setNome($data['nome']);
        $this->produto->setDescricao($data['descricao']);
        $this->produto->setValor($data['valor']);

        return $this->produtoMapper->update($this->produto);
    }

    public function insert(array $data)
    {
        $this->produto->setNome($data['nome']);
        $this->produto->setDescricao($data['descricao']);
        $this->produto->setValor($data['valor']);

        $result = $this->produtoMapper->insert($this->produto);

        return $result;
    }

} 