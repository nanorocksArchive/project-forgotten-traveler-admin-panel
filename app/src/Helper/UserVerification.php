<?php

namespace App\Helper;

use Respect\Validation\Validator;

trait UserVerification {

    // Move this to trait in helper
    public static function validateRegistration($user)
    {
        // Validate body request
        $username = Validator::attribute('username', Validator::stringType()->length(8, 32));
        $password = Validator::attribute('password', Validator::stringType()->length(8, 32));
        $email = Validator::attribute('email', Validator::email());

        var_dump($username->validate($user));
    }


}