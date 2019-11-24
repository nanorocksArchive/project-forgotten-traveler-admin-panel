<?php

namespace App\Controller;

use App\Model\Admin;
use App\Model\Level;
use App\Model\User;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AdminController extends BaseController
{
    /**
     * Loading view for login
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function index(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        return $this->container['twig']->render($response, 'login/index.php.twig', []);
    }


    public function loginWeb(RequestInterface $request, ResponseInterface $response, $args = [])
    {

//        $admin = new Admin([
//            'email' => 'email@gmail.com',
//            'password' => 'password123'
//        ]);


        //var_dump($this->container['db']->table('admins')->get());

        var_dump(Admin::all());
        die();
        //var_dump($request->getParsedBody());

        // set params

        // validate params

        // check user in db

        // login user

        // redirect user

    }

    /**
     * Load dashboard
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function dashboard(RequestInterface $request, ResponseInterface $response, $args = [])
    {

        $levels = Level::all();
        $totalUsers = User::count();
        $msg = $this->container['flash']->getMessages();
        return $this->container['twig']->render($response, 'dashboard/index.php.twig', [
            'totalUsers' => $totalUsers,
            'levels' => $levels,
            'msg' => $msg
        ]);
    }

    /**
     * Loading view for new level form
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function newLevelWeb(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $totalUsers = User::count();

        return $this->container['twig']->render($response, 'level/manage.php.twig', [
            'totalUsers' => $totalUsers,
        ]);
    }

    /**
     * Store new level
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function storeNewLevelWeb(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $requestParams = $request->getParsedBody();

        $level = new Level();
        $level->name = $requestParams['name'];
        $level->total_stars = $requestParams['total_stars'];
        $level->total_coins = $requestParams['total_coins'];
        $success = $level->save();

        if($success)
        {
            $this->container['flash']->addMessage('alert-success', 'You add new level with name: ' . $level->name);
            return $response->withRedirect('/dashboard');
        }

        $this->container['flash']->addMessage('alert-warning', 'Something went wrong. Adding new level is not success.');
        return $response->withRedirect('/dashboard');
    }

    /**
     * Edit level in form
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function editLevelWeb(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $levelId = $args['id'];
        $level = Level::find($levelId);
        $totalUsers = User::count();

        return $this->container['twig']->render($response, 'level/manage.php.twig', [
            'totalUsers' => $totalUsers,
            'level' => $level
        ]);
    }

    /**
     * Update level
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function updateLevelWeb(RequestInterface $request, ResponseInterface $response, $args = [])
    {

        $levelId = $args['id'];
        $requestParams = $request->getParsedBody();

        $level = Level::find($levelId);
        $level->name = $requestParams['name'];
        $level->total_coins = $requestParams['total_coins'];
        $level->total_stars = $requestParams['total_stars'];
        $success = $level->save();

        if($success)
        {
            $this->container['flash']->addMessage('alert-info', 'You update level with name: ' . $level->name);
            return $response->withRedirect('/dashboard');
        }

        $this->container['flash']->addMessage('alert-warning', 'Something went wrong. Update is not success.');
        return $response->withRedirect('/dashboard');
    }

    /**
     * Delete level
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return mixed
     */
    public function deleteLevelWeb(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $levelId = $args['id'];
        $level = Level::find($levelId);
        $success = $level->delete();

        if($success)
        {
            $this->container['flash']->addMessage('alert-danger', 'You delete level with name: ' . $level->name);
            return $response->withRedirect('/dashboard');
        }

        $this->container['flash']->addMessage('alert-warning', 'Something went wrong. Deleting level is not success.');
        return $response->withRedirect('/dashboard');
    }
}