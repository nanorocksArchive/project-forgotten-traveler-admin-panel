<?php

namespace App\Controller;

use Illuminate\Database\Capsule\Manager as DB;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AnalyseController extends BaseController {

    /**
     * Total score per auth user
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function totalScoreGamePlay(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $data = $request->getAttribute('jwsData');

        $username = $data['payload']['username'];
        $password = $data['payload']['password'];

        $query = "SELECT 
                u.id, 
                u.email, 
                u.username, 
                u.activation, 
                SUM(s.coins) AS total_coints, 
                SUM(s.stars) AS total_stars, 
                (SUM(s.coins) + SUM(s.stars)) as total_score 
                FROM `scores` AS s 
                JOIN `users` AS u 
                ON s.id_user = u.id 
                WHERE u.username = :username 
                AND u.password = :password
                GROUP BY u.id";

        $user = DB::connection()->select($query, [':username' => $username, ':password' => $password]);
        if(!$user){
            return $response->withJson([
                'message' => "Invalid user",
                'code' => 409
            ], 409);
        }

        return $response->withJson([
            'message' => "Personal info",
            'data' => [
                'user' => $user[0],
            ],
            'code' => 200
        ], 200);
    }

}