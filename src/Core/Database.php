<?php

namespace App\Core;

class Database
{
    private function __construct() {}

    private static $db;

    public static function conn()
    {
        if (empty($db))
        {
            try {
                $c = new \PDO("mysql:host={$_ENV["DB_HOST"]};dbname={$_ENV["DB_NAME"]}", $_ENV["DB_USER"], $_ENV["DB_PASS"]);
                self::$db = $c;        
            }
            catch (\PDOException $e) {
                header('HTTP/1.1 500');
                die();
            }
        }
        
        return self::$db;
    }
}