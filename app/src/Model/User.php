<?php

namespace App\Model;

class User{

    protected $id;

    protected $username;

    protected $password;

    protected $email;

    protected $totalTime;

    public function __construct($username, $password, $email, $totalTime)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->totalTime = $totalTime;
    }

    public function store()
    {
        return 1;
    }
}