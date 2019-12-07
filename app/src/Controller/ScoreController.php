<?php

namespace App\Controller;

use App\Helper\ScoreValidation;
use App\Model\Score;
use App\Model\User;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ScoreController extends BaseController{

    use ScoreValidation;

    /**
     * Store scores
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function store(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $data = $request->getAttribute('jwsData');

        $username = $data['payload']['username'];
        $password = $data['payload']['password'];

        $user = User::where('username', '=', $username)->where('password', '=', $password)->first();
        if(!$user){
            return $response->withJson([
                'message' => "Invalid token",
                'code' => 200
            ], 200);
        }

        $params = $request->getParams();

        $userId = $user->id;
        $levelId = $params['level-id'];
        $coins = $params['coins'];
        $stars = $params['stars'];
        $time = $params['time'];

        // validate request
        $errors = ScoreValidation::validateScore($params);

        if (!empty($errors))
        {
            return $response->withJson([
                'message' => "Invalid data",
                'err' => $errors,
                'code' => 409
            ], 409);
        }

        $score = Score::where('id_user', '=',  $userId)->where('id_level', '=', $levelId)->first();

        if($score == null)
        {
            $score = new Score();
            $score->id_user = $userId;
            $score->id_level = $levelId;
        }

        $score->coins = $coins;
        $score->stars = $stars;
        $score->time = $time;
        $success = $score->save();

        if($success)
        {
            return $response->withJson([
                'message' => "Score stored",
                'code' => 201
            ], 201);
        }

        return $response->withJson([
            'message' => "Can't store score",
            'code' => 409
        ], 409);
    }

    /**
     * Get all scores peru user
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function getScore(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $data = $request->getAttribute('jwsData');

        $username = $data['payload']['username'];
        $password = $data['payload']['password'];

        $user = User::where('username', '=', $username)->where('password', '=', $password)->first();
        if(!$user){
            return $response->withJson([
                'message' => "Invalid token",
                'code' => 200
            ], 200);
        }

        $scores = Score::where('id_user', '=', $user->id)->get();

        return $response->withJson([
            'message' => "Score for user",
            'data' => [
                'scores' => $scores,
            ],
            'code' => 200
        ], 200);
    }
}