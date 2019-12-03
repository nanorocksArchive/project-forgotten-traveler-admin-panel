<?php


namespace App\Helper;

use App\Model\User;
use Rakit\Validation\Validator;

trait UserRegistrationValidation
{

    public static function validateRegistration($params)
    {
        $validator = new Validator();

        $validation = $validator->make($params, [
            'username' => 'required|alpha_num',
            'email' => 'required|email',
            'password' => 'required|min:6',
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


}