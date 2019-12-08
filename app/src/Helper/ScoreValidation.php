<?php


namespace App\Helper;

use App\Model\Level;
use Rakit\Validation\Validator;

trait ScoreValidation
{
    /**
     * Validate registration
     *
     * @param $params
     * @return array
     */
    public static function validateScore($params)
    {
        $validator = new Validator();

        $validation = $validator->make($params, [
            'level-id' => 'required|numeric',
            'coins' => 'required|numeric',
            'stars' => 'required|numeric',
            'time' => 'required|max:10'
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

        $level = Level::find($params['level-id']);
        if ($level == null)
        {
            $err['level-id'] = 'Level not exist';
        }

        return $err;
    }
}