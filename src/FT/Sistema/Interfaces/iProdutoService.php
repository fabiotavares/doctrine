<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 17/11/14
 * Time: 13:42
 */

namespace FT\Sistema\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface iProdutoService
{
    function getAll(Request $request);
    function getProdutos(Request $request);
    function fetch($id);
    function delete($id);
    function update(array $data);
    function insert(array $data);
} 