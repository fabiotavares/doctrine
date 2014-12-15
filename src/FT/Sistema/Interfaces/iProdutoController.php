<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 17/11/14
 * Time: 13:42
 */

namespace FT\Sistema\Interfaces;

use Silex\Application;
use Doctrine\ORM\EntityManager;

interface iProdutoController
{
    function getController(Application $app);
} 