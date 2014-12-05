<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 17/11/14
 * Time: 13:40
 */

namespace FT\Sistema\Interfaces;

interface iProduto
{
    function getId();
    function getNome();
    function setNome($nome);
    function getValor();
    function setValor($valor);
    function getDescricao();
    function setDescricao($descricao);
} 