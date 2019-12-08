<?php

namespace App\Helper;

use Rakit\Validation\Validator;

trait AdminValidation
{
    /**
     * Validate login panel
     *
     * @param $params
     * @return array
     */
    public static function validateWebLogin($params)
    {
        $validator = new Validator;

        $validation = $validator->make($params, [
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

        return [];
    }


}