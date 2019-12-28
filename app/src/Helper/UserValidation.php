<?php


namespace App\Helper;

use App\Model\User;
use Rakit\Validation\Validator;

trait UserValidation
{

    /**
     * Validate registration
     *
     * @param $params
     * @return array
     */
    public static function validateRegistration($params)
    {
        $validator = new Validator();

        $validation = $validator->make($params, [
            'username' => 'required|alpha_num',
            'email' => 'required|email',
            'password' => 'required|min:6|max:20',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $errors = $validation->errors()->toArray();
            $msgErrors = [];
            foreach ($errors as $key => $errMsg) {
                $msgErrors[$key] = array_values($errMsg);
            }

            return $msgErrors;
        }

        $err = [];

        $user = User::where('username', '=', trim($params['username']))->first();
        if ($user)
        {
            $err['username'] = 'The username is already used';
        }

        $user = User::where('email', '=', trim($params['email']))->first();
        if ($user)
        {
            $err['email'] = 'The email is already used';
        }

        return $err;
    }

    /**
     * Validate user before login
     *
     * @param $params
     * @return array
     */
    public static function validateLogin($params)
    {

        $validator = new Validator();

        $validation = $validator->make($params, [
            'username' => 'required|alpha_num',
            'password' => 'required|min:6|max:20',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $errors = $validation->errors()->toArray();
            $msgErrors = [];
            foreach ($errors as $key => $errMsg) {
                $msgErrors[$key] = array_values($errMsg);
            }

            return $msgErrors;
        }

        return [];

    }

    /**
     * Validate new password
     *
     * @param $params
     * @return array
     */
    public static function validateNewPassword($params)
    {
        $validator = new Validator();

        $validation = $validator->make($params, [
            'new-password' => 'required|min:6|max:20',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $errors = $validation->errors()->toArray();
            $msgErrors = [];
            foreach ($errors as $key => $errMsg) {
                $msgErrors[$key] = array_values($errMsg);
            }

            return $msgErrors;
        }

        return [];
    }

    /**
     * Validate total time
     *
     * @param $params
     * @return array
     */
    public static function validateTotalTime($params)
    {
        $validator = new Validator();

        $validation = $validator->make($params, [
            'total-time' => 'required|numeric',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $errors = $validation->errors()->toArray();
            $msgErrors = [];
            foreach ($errors as $key => $errMsg) {
                $msgErrors[$key] = array_values($errMsg);
            }

            return $msgErrors;
        }

    }

    /**
     * Validate email
     *
     * @param $params
     * @return array
     */
    public static function validateEmail($params)
    {
        $validator = new Validator();

        $validation = $validator->make($params, [
            'email' => 'required|email',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $errors = $validation->errors()->toArray();
            $msgErrors = [];
            foreach ($errors as $key => $errMsg) {
                $msgErrors[$key] = array_values($errMsg);
            }

            return $msgErrors;
        }

        $err = [];

        $user = User::where('email', '=', trim($params['email']))->first();
        if (!$user)
        {
            $err['email'] = 'Email not exist';
        }

        return $err;
    }
}