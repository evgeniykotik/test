<?php

class User implements JsonSerializable
{

    private $login;
    private $password;
    private $email;
    private $name;

    public function __construct($login, $password, $email, $name)
    {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->name = $name;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getName()
    {
        return $this->name;
    }

    public function jsonSerialize()
    {
        return [
            "login" => $this->login,
            "password" => $this->password,
            "email" => $this->email,
            "name" => $this->name
        ];
    }
}