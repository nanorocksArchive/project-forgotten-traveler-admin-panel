<?php

namespace App\Controller;

use App\Helper\UserVerification;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Model\User;

class UserController extends BaseController
{
    use UserVerification;

    public function index(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        return $this->container['twig']->render('login/index.php.twig', []);
    }

    public function loginWeb(RequestInterface $request, ResponseInterface $response, $args = [])
    {

    }

    public function dashboard(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        return $this->container['twig']->render('dashboard/index.php.twig', []);
    }

    public function newLevelWeb(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        return $this->container['twig']->render('level/manage.php.twig', []);
    }

    public function editLevelWeb()
    {

    }

    public function registerApi(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $params = $request->getParams();

        $username = $params['username'];
        $password = $params['password'];
        $email = $params['email'];
        $totalTime = $password['total-time'];

        //$this->validateRegistration($user);

        $user = new User($username, md5($password), $email, $totalTime);
        $success = $user->store();

        if(!$success)
        {
            return $response->withJson([
                'message' => "There is a CONFLICT",
                'code' => 409
            ], 409);
        }

        return $response->withJson([
            'message' => "User created",
            'code' => 200
        ], 200);
    }

    public function loginApi(RequestInterface $request, ResponseInterface $response, $args = [])
    {

    }

    public function editApi(RequestInterface $request, ResponseInterface $response, $args = [])
    {

    }

    public function logoutApi(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        return $response->withJson([
            'message' => "Delete token form client side",
            'code' => 200
        ], 200);
    }

    public function forgotPasswordApi(RequestInterface $request, ResponseInterface $response, $args = [])
    {

    }

    public function totalApi(RequestInterface $request, ResponseInterface $response, $args = [])
    {
    }
}