<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;

class BaseController{

    public $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}