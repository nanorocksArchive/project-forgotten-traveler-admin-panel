<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;

class BaseController{

    /**
     * @var ContainerInterface
     */
    public $container;

    /**
     * BaseController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}