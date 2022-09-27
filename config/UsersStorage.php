<?php
require_once 'CrudStorage.php';
require_once 'User.php';

class UsersStorage extends CrudStorage
{
    const FILE_NAME = 'userStorage.json';

    private static $instance;

    private $listUsers = array();

    private function __construct()
    {
        $json = file_get_contents(self::FILE_NAME);
        $jsonValue = json_decode($json, false);
        foreach ($jsonValue as $u) {
            $user = new User($u->login, $u->password, $u->email, $u->name);
            $this->listUsers[] = $user;
        }
    }

    static public function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    function create($data)
    {
        $this->listUsers[] = $data;
        $this->saveUsersToFile();
    }

    function read($uniqueField)
    {
        foreach ($this->listUsers as $u) {
            if ($u->getLogin() == $uniqueField) {
                return $u;
            }
        }
        return null;
    }

    public function update($data)
    {
        foreach ($this->listUsers as $u) {
            if ($u->login == $data->login) {
                $u->password = $data->password;
                $u->email = $data->email;
                $u->name = $data->name;
                $this->saveUsersToFile();
                return;
            }
        }
    }

    public function delete($data)
    {
        foreach ($this->listUsers as $key => $u) {
            if ($u->login == $data->login) {
                array_splice($this->listUsers, $key, 1);
                $this->saveUsersToFile();
                return;
            }
        }
        $this->saveUsersToFile();
    }

    private function saveUsersToFile()
    {
        file_put_contents(self::FILE_NAME, json_encode($this->listUsers));
    }
}