<?php

namespace App\Model;

class User{

    protected $id;

    protected $username;

    protected $password;

    protected $email;

    protected $totalTime;

    protected $container;

    public function __construct($container)
    {
        $this->container = $container['db'];
    }

    public function store()
    {
        return 1;
    }

    public function userCheck($email, $password)
    {
        var_dump($this->container);
    }


}