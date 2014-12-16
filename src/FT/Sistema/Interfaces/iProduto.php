<?php

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