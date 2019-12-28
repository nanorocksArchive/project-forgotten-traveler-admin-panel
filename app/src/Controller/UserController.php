<?php

namespace App\Controller;

use App\Helper\MailSender;
use App\Helper\UserValidation;
use App\Model\ForgotPassword;
use Gamegos\JWS\JWS;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Model\User;
use TheSeer\Tokenizer\Exception;

class UserController extends BaseController
{
    use UserValidation;
    use MailSender;

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

        if (!empty($errors)) {
            return $response->withJson([
                'message' => "Invalid data",
                'err' => $errors,
                'code' => 409
            ], 409);
        }

        $user = new User();
        $user->username = $username;
        $user->password = md5($password);
        $user->email = $email;
        $user->total_time = $totalTime;
        $user->activation = 0;
        $success = $user->save();

        if (!$success) {
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

        if (!empty($errors)) {
            return $response->withJson([
                'message' => "Invalid data",
                'err' => $errors,
                'code' => 409
            ], 409);
        }

        $user = User::where('username', '=', $username)->where('password', '=', md5($password))->first();
        if (!$user) {
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
        $token = sprintf("%s %s", $config['access'], $token);

        return $response->withJson([
            'message' => "Success",
            'token' => $token,
            'code' => 200
        ], 200);
    }

    /**
     * Change new password
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function changePassword(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $data = $request->getAttribute('jwsData');
        $username = $data['payload']['username'];
        $oldPassword = $data['payload']['password'];

        $params = $request->getParams();
        $newPassword = $params['new-password'];

        // validate new password
        $errors = UserValidation::validateNewPassword($params);

        if (!empty($errors)) {
            return $response->withJson([
                'message' => "Invalid data",
                'err' => $errors,
                'code' => 409
            ], 409);
        }

        $user = User::where('username', '=', $username)->where('password', '=', $oldPassword)->first();
        if (!$user) {
            return $response->withJson([
                'message' => "Invalid token",
                'code' => 200
            ], 200);
        }

        $user->password = md5($newPassword);
        $success = $user->save();

        if ($success) {
            return $response->withJson([
                'message' => "Your password is changed",
                'report' => "Delete token form client side and logout user",
                'code' => 200
            ], 200);
        }

        return $response->withJson([
            'message' => "Your password can't be changed",
            'code' => 200
        ], 200);
    }

    /**
     * Logout user
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function logoutUser(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        return $response->withJson([
            'message' => "Your are logout",
            'report' => "Delete token form client side and logout user",
            'code' => 200
        ], 200);
    }

    /**
     * Personal info for user
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function personalInfo(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $data = $request->getAttribute('jwsData');

        $username = $data['payload']['username'];
        $password = $data['payload']['password'];

        $user = User::where('username', '=', $username)->where('password', '=', $password)->first();
        if (!$user) {
            return $response->withJson([
                'message' => "Invalid token",
                'code' => 200
            ], 200);
        }

        return $response->withJson([
            'message' => "Personal info",
            'data' => [
                'username' => $username,
                'email' => $user->email,
                'total_time' => $user->total_time
            ],
            'code' => 200
        ], 200);
    }

    /**
     * Update total time
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function totalTime(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $data = $request->getAttribute('jwsData');

        $username = $data['payload']['username'];
        $password = $data['payload']['password'];

        $user = User::where('username', '=', $username)->where('password', '=', $password)->first();
        if (!$user) {
            return $response->withJson([
                'message' => "Invalid token",
                'code' => 200
            ], 200);
        }

        $params = $request->getParams();
        $totalTime = $params['total-time'];

        // validate total time
        $errors = UserValidation::validateTotalTime($params);

        if (!empty($errors)) {
            return $response->withJson([
                'message' => "Invalid data",
                'err' => $errors,
                'code' => 409
            ], 409);
        }

        $user->total_time = $totalTime;
        $success = $user->save();

        if ($success) {
            return $response->withJson([
                'message' => "You update total time",
                'code' => 200
            ], 200);
        }

        return $response->withJson([
            'message' => "Total time for user can't be changed",
            'code' => 200
        ], 200);
    }

    /**
     * Send mail with reset password link
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function forgotPassword(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $params = $request->getParams();
        $email = $params['email'];

        // validate email
        $errors = UserValidation::validateEmail($params);
        if (!empty($errors)) {
            return $response->withJson([
                'message' => "Invalid data",
                'err' => $errors,
                'code' => 409
            ], 409);
        }

        $user = User::where('email', '=', $email)->first();
        $username = $user->username;

        $http = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $hash = bin2hex(openssl_random_pseudo_bytes(16));
        $resetCode = sprintf('%s%s/password/%s',
            $http,
            $_SERVER['HTTP_HOST'],
            $hash
        );

        $fp = ForgotPassword::find($user->id);
        if ($fp == null) {
            $fp = new ForgotPassword();
        }

        $fp->reset = $hash;
        $fp->id_user = $user->id;
        $fp->save();

        $success = MailSender::send(
            $this->container,
            $username,
            $email,
            $resetCode
        );

        if ($success) {
            return $response->withJson([
                'message' => "Check your email",
                'code' => 200
            ], 200);
        }

        return $response->withJson([
            'message' => "Message not send contact admin",
            'code' => 200
        ], 200);
    }

    /**
     * Add new password
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function enterPassword(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $token = $args['token'];
        $ft = ForgotPassword::where('reset', '=', $token)->first();
        $expire = 0;
        $tokenMsg = 'Invalid token. Try again.';
        if ($ft == null) {
            return $this->container['twig']->render($response, 'user/forgot-password.php.twig', [
                'tokenExpire' => $expire,
                'token' => $token,
                'tokenMsg' => $tokenMsg
            ]);
        }

        $forgotPassword = $ft->toArray();
        $updatedDate = date('Y-m-d H:m:s', strtotime($forgotPassword['updated_at'] . ' +1 day'));
        $today = date('Y-m-d H:m:s');
        $expire = 1;

        if (strtotime($updatedDate) <= strtotime($today)) {
            $ft->delete();
            $expire = 0;
            $tokenMsg = 'Token expired. Try again.';
        }

        return $this->container['twig']->render($response, 'user/forgot-password.php.twig', [
            'tokenExpire' => $expire,
            'token' => $token,
            'tokenMsg' => $tokenMsg
        ]);
    }

    /**
     * Save password on submit forgot password by user
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     * @throws \Exception
     */
    public function submitPassword(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $token = $args['token'];
        $ft = ForgotPassword::where('reset', '=', $token)->first();
        $expire = 0;
        $tokenMsg = 'Invalid token. Try again.';
        if ($ft == null) {
            return $this->container['twig']->render($response, 'user/forgot-password.php.twig', [
                'tokenExpire' => $expire,
                'token' => $token,
                'tokenMsg' => $tokenMsg
            ]);
        }

        try {
            $post = $request->getParsedBody();
            $errors = UserValidation::validateNewPassword($post);
            if (!empty($errors)) {
                $expire = 1;
                return $this->container['twig']->render($response, 'user/forgot-password.php.twig', [
                    'tokenExpire' => $expire,
                    'token' => $token,
                    'tokenMsg' => $tokenMsg,
                    'err' => $errors
                ]);
            }

            $ftArray = $ft->toArray();
            $user = User::find($ftArray['id_user'])->first();
            $user->password = md5($post['new-password']);
            $success = $user->save();
            if(!$success)
            {
                throw new \Exception('Password not saved.');
            }
            $ft->delete();

        } catch (Exception $e) {
            return $this->container['twig']->render($response, 'user/forgot-password.php.twig', [
                'tokenExpire' => $expire,
                'token' => $token,
                'tokenMsg' => $tokenMsg
            ]);
        }
        $expire = 0;
        $successMsg = 'Password changed. Continue to play.';
        return $this->container['twig']->render($response, 'user/forgot-password.php.twig', [
            'tokenExpire' => $expire,
            'token' => $token,
            'tokenMsg' => $tokenMsg,
            'successMsg' => $successMsg
        ]);

    }
}