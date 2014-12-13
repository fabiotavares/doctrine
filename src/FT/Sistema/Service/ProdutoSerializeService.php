<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 12/12/2014
 * Time: 15:45
 */

namespace FT\Sistema\Service;

use FT\Sistema\Entity\Produto;

class ProdutoSerializeService
{
    public function ProdutoToArray(Produto $produto)
    {
        $result = [
            "id" => $produto->getId(),
            "nome" => $produto->getNome(),
            "valor" => $produto->getValor(),
            "descricao" => $produto->getDescricao()
        ];

        return $result;
    }

    public function ArrayOfProdutoToArray(array $array)
    {
        $result = [];
        foreach($array as $produto) {
            $result[] = $this->ProdutoToArray($produto);
        }

        return $result;
    }
}