<?php

abstract class CrudStorage
{
    abstract function create($data);

    abstract function read($uniqueField);

    abstract function update($data);

    abstract function delete($data);

    static function getUsersStorage() : CrudStorage
    {
        return UsersStorage::getInstance();
    }
}
