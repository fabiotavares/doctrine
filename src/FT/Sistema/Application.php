<?php
/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 15/12/2014
 * Time: 13:50
 */

namespace FT\Sistema;

use Silex\Application as SilexApp;

class Application extends SilexApp
{
    public function __construct(array $values = array())
    {
        parent::__construct($values);

        $app = $this;

        $app->register(new \Silex\Provider\TwigServiceProvider(), array(
            'twig.path' => __DIR__.'/views',
        ));
        $app->register(new \Silex\Provider\UrlGeneratorServiceProvider());
    }
}