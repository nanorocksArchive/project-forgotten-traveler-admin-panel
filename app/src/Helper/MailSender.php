<?php

namespace App\Helper;

use \Mailjet\Resources;

trait MailSender
{
    public static function send($username, $email, $subject, $msg)
    {
        $config = require __DIR__ . '/../config.php';

        $mj = new \Mailjet\Client(
            'd813129af503e903ff40fae06f65e57f',
            '18c50ea2fb82dde307d66a0ef3460604',
            true,
            ['version' => 'v3.1']
        );

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "bot@ftadmin.php.mk",
                        'Name' => "Forgot password - Forgotten Traveler"
                    ],
                    'To' => [
                        [
                            'Email' => "andrejnankov@gmail.com",
                            'Name' => "Andrej"
                        ]
                    ],
                    'Subject' => "Forgot password - Forgotten Traveler",
                    'TextPart' => "My first Mailjet email",
                    'HTMLPart' => "<h3>Dear passenger 1, welcome to <a href='https://www.mailjet.com/'>Mailjet</a>!</h3><br />May the delivery force be with you!",
                    'CustomID' => "AppGettingStartedTest"
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
    }
}