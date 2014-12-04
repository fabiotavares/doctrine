<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 17/11/14
 * Time: 13:41
 */

namespace FT\Sistema\Interfaces;


interface iProdutoMapper
{
    function fetchAll();
    function fetch($id);
    function delete($id);
    function update(iProduto $produto);
    function insert(iProduto $produto);
} 