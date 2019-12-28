<?php

namespace App\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GuestMiddleware{

    public $container;

    /**
     * GuestMiddleware constructor.
     * @param \Slim\Container $container
     */
    public function __construct(\Slim\Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param $next
     * @return ResponseInterface
     */
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

