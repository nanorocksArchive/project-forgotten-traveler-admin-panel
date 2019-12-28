<?php

namespace App\Helper;

use \Mailjet\Resources;

trait MailSender
{
    /**
     * @param $container
     * @param $username
     * @param $email
     * @param $resetLink
     * @return bool
     */
    public static function send($container, $username, $email, $resetLink)
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
                    'Subject' => sprintf("%s - Reset password", $config['mail']['senderName']),
                    'TextPart' => "",
                    'HTMLPart' => self::htmlTemplate($resetLink),
                    'CustomID' => $config['mail']['customId']
                ]
            ]
        ];

        $response = $mj->post(Resources::$Email, ['body' => $body]);

        return $response->success();
    }

    /**
     * @param $resetLink
     * @return string
     */
    private static function htmlTemplate($resetLink)
    {
        return "<a href='" . $resetLink . "'>Reset password</a>";
    }
}