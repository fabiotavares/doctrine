<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 15/12/2014
 * Time: 13:50
 */

namespace FT\Sistema;

use Silex\Application as SilexApp;
use Doctrine\ORM\EntityManager;
use FT\Sistema\Service\ProdutoValidatorService;
use FT\Sistema\Service\ProdutoSerializeService;
use FT\Sistema\Service\ProdutoService;

class Application extends SilexApp
{
    public function __construct(array $values = array(), EntityManager $em)
    {
        parent::__construct($values);

        $app = $this;

        $app->register(new \Silex\Provider\TwigServiceProvider(), array(
            'twig.path' => __DIR__.'/views',
        ));
        $app->register(new \Silex\Provider\UrlGeneratorServiceProvider());

        $app['produtoService'] = function() use($em) {
            return new ProdutoService($em);
        };

        $app['produtoValidatorService'] = function() use($em) {
            return new ProdutoValidatorService();
        };

        $app['produtoSerializeService'] = function() use($em) {
            return new ProdutoSerializeService();
        };

    }
}