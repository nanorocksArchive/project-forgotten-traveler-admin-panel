<?php

namespace App\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GuestMiddleware
{
    public $container;

    public function __construct(\Slim\Container $container)
    {
        $this->container = $container;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, $next)
    {
        $session = $this->container['session'];
        $exists = $session->exists('user');

//        if(!$exists)
//        {
//            return $response->withRedirect('/');
//        }

        $response = $next($request, $response);
        return $response;
    }
}


