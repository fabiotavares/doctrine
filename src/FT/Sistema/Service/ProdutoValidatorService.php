<?php

namespace FT\Sistema\Service;

use FT\Sistema\Entity\Produto;

class ProdutoValidatorService
{
    public function validate(array $dados)
    {
        //valida completamente todos os atributos de um produto
        //todos devem existir
        if(!isset($dados['nome'])) throw new \InvalidArgumentException("Nome de produto nao informado");
        if(!isset($dados['valor'])) throw new \InvalidArgumentException("Valor de produto nao informado");
        if(!isset($dados['descricao'])) throw new \InvalidArgumentException("Descricao de produto nao informado");

        //nome deve ser diferente de vazio
        $dados['nome'] = trim($dados['nome']);
        if(empty($dados['nome'])) throw new \InvalidArgumentException("Nome de produto deve possuir algum valor");

        //valor deve ser um valor numérico positivo
        if(!is_numeric($dados['valor']) || $dados['valor'] < 0) throw new \InvalidArgumentException("Valor de produto deve possuir algum valor positivo");

        //descricao deve ser diferente de vazio
        $dados['descricao'] = trim($dados['descricao']);
        if(empty($dados['descricao'])) throw new \InvalidArgumentException("Descricao de produto deve possuir algum valor");

        //validação aprovada
        return $dados;
      }

    public function validateParcial(array $dados, Produto $produto)
    {
        //valida parcialmente os atributos de um produto (apenas os informados)
        //completa os atributos faltantes
        if(!isset($dados['id'])) $dados['id'] = $produto->getId();
        if(!isset($dados['nome'])) $dados['nome'] = $produto->getNome();
        if(!isset($dados['valor'])) $dados['valor'] = $produto->getValor();
        if(!isset($dados['descricao'])) $dados['descricao'] = $produto->getDescricao();
        //retorna a validação completa agora
        return $this->validate($dados);
    }
}