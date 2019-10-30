<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class UserController extends BaseController
{

    public function index(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        //$db = $this->container['db'];
        //var_dump($db);

        return $response->getBody()->write("Hello From User controller");
    }

    public function register()
    {

    }

    public function login()
    {

    }

    public function logout()
    {

    }
}