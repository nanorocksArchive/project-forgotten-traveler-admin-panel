<?php

namespace App\Helper;

use \Mailjet\Resources;

trait MailSender
{
    public static function send($username, $email, $resetLink)
    {
        $config = require __DIR__ . '/../config.php';

        $mj = new \Mailjet\Client(
            $config['mail']['key'],
            $config['mail']['secret'],
            $config['mail']['call'],
            $config['mail']['version']
        );

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => $config['mail']['senderEmail'],
                        'Name' => $config['mail']['senderName']
                    ],
                    'To' => [
                        [
                            'Email' => $email,
                            'Name' => $username
                        ]
                    ],
                    'Subject' => sprintf("%s - New password", $config['mail']['senderName']),
                    'TextPart' => "",
                    'HTMLPart' => "<a href='" . $resetLink . "'>New password</a>",
                    'CustomID' => $config['mail']['customId']
                ]
            ]
        ];

        $response = $mj->post(Resources::$Email, ['body' => $body]);

        return $response->success();
    }
}