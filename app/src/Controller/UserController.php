<?php

namespace App\Controller;

use App\Helper\UserValidation;
use Gamegos\JWS\JWS;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Model\User;

class UserController extends BaseController
{
    use UserValidation;

    /**
     * Register new user in api
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function registerUser(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $params = $request->getParams();

        $username = $params['username'];
        $password = $params['password'];
        $email = $params['email'];
        $totalTime = 0;

        $errors = UserValidation::validateRegistration($params);

        if (!empty($errors))
        {
            return $response->withJson([
                'message' => "Invalid data",
                'err' => $errors,
                'code' => 409
            ], 409);
        }

        $user = new User();
        $user->username = $username;
        $user->password =  md5($password);
        $user->email = $email;
        $user->total_time = $totalTime;
        $user->activation = 0;
        $success = $user->save();

        if(!$success)
        {
            return $response->withJson([
                'message' => "There is a CONFLICT",
                'code' => 409
            ], 409);
        }

        return $response->withJson([
            'message' => "User created",
            'code' => 201
        ], 201);
    }

    /**
     * Login api user
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function loginUser(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $params = $request->getParams();

        $username = $params['username'];
        $password = $params['password'];

        $errors = UserValidation::validateLogin($params);

        if (!empty($errors))
        {
            return $response->withJson([
                'message' => "Invalid data",
                'err' => $errors,
                'code' => 409
            ], 409);
        }

        $user = User::where('username', '=', $username)->where('password', '=', md5($password))->first();
        if(!$user){
            return $response->withJson([
                'message' => "Invalid username or password",
                'code' => 200
            ], 200);
        }

        $config = $this->container['settings']['jws'];
        $headers = [
            'alg' => $config["headers"]['alg'],
            'typ' => $config["headers"]['typ']
        ];

        $payload = [
            'username' => $user->username,
            'password' => $user->password
        ];

        $key = $config['key'];

        $jws = new JWS();
        $token = $jws->encode($headers, $payload, $key);
        $token = sprintf("%s %s", $config['access'] , $token);

        return $response->withJson([
            'message' => "Success",
            'token' => $token,
            'code' => 200
        ], 200);
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