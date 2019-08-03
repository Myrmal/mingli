<?php

/**
 * Class ConnectionDB
 * Класс подключения к БД
 */
class ConnectionDB
{
    /**
     * @return PDO
     */
    public function connectionMysql()
    {
        require_once "config.php";
        $db = new PDO('mysql:host='.Config::$db_host.'; dbname='.Config::$db_name, Config::$db_user, Config::$db_password);
        return $db;
    }
}