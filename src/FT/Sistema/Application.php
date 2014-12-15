<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 15/12/2014
 * Time: 13:50
 */

namespace FT\Sistema;

use Silex\Application as SilexApp;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;

use FT\Sistema\Service\ProdutoService;
use FT\Sistema\Service\ProdutoValidatorService;
use FT\Sistema\Service\ProdutoSerializeService;

class Application extends SilexApp
{
    public function __construct(array $values = array())
    {
        parent::__construct($values);

        $app = $this;

        $app->register(new TwigServiceProvider(), array(
            'twig.path' => __DIR__.'/views',
        ));
        $app->register(new UrlGeneratorServiceProvider());
        
        $app['produtoService'] = function() use($app) {
            return new ProdutoService($app["em"]);
        };

        $app['produtoValidatorService'] = function() {
            return new ProdutoValidatorService();
        };

        $app['produtoSerializeService'] = function() {
            return new ProdutoSerializeService();
        };
    }
}