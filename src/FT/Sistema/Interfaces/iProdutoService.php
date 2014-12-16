<?php

namespace FT\Sistema\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface iProdutoService
{
    function findAll();
    function getProdutos(Request $request);
    function fetch($id);
    function delete($id);
    function update(array $data);
    function insert(array $data);
} 