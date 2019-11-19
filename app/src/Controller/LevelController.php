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

    public function editLevelWeb(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        return $this->container['twig']->render('level/manage.php.twig', []);
    }


}