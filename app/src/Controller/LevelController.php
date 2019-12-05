<?php

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Model\Level;

class LevelController extends BaseController
{

    /**
     * Load view form for new level
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function newLevelWeb(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        return $this->container['twig']->render('level/manage.php.twig', []);
    }

    /**
     * Load view for edit new level
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function editLevelWeb(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        return $this->container['twig']->render('level/manage.php.twig', []);
    }


    /**
     * Show all levels
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function showLevels(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $levels = Level::all()->toArray();

        return $response->withJson([
            'message' => "All levels",
            'data' => [
                'levels' => $levels,
            ],
            'code' => 200
        ], 200);
    }


}