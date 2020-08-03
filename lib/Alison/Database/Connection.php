<?php

namespace Alison\Database;

abstract class Connection
{
    
    private static $conn;

    public static function getConn()
    {
        if (!self::$conn) {
            self::$conn = new \PDO('mysql:host=localhost:3307;dbname=db_login;charset=utf8', 'root', '');
        }

        return self::$conn;
    }
}