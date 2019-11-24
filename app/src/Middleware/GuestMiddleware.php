<?php

namespace App\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AuthMiddleware{

    public $container;

    public function __construct(\Slim\Container $container)
    {
        $this->container = $container;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, $next)
    {
        $session = $this->container['session'];
        $exists = $session->exists('admin');

        if($exists)
        {
            return $response->withRedirect('/dashboard');
        }

        $response = $next($request, $response);
        return $response;
    }
}

