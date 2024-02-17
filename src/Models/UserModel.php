<?php

namespace App\Models;

use \App\Core\Database as db;

class UserModel extends \App\Core\ActiveRecordEntity
{
    public $username;
    public $hashedPassword;

    public static function getTableName(): string
    {
        return 'user';
    }

    public static function isUserExists(string $username)
    {
        $stmt = db::conn()->prepare("SELECT * FROM user WHERE username=:username");
        $stmt->bindValue(":username", $username, \PDO::PARAM_STR);
        $stmt->execute(); 
        if (!empty($stmt->fetch(\PDO::FETCH_NUM)))
            return true;
        return false;
    }

    public static function isUserPasswordMatches(string $username, string $password)
    {
        $stmt = db::conn()->prepare(
            "SELECT hashedPassword FROM user WHERE username=:username"
        );
        $stmt->bindValue(":username", $username);
        $stmt->execute();
        $p = $stmt->fetch(\PDO::FETCH_NUM)[0];

        if ($p === md5($password))
            return true;

        return false;
    }

    public static function getUserByUsername(string $username)
    {
        $stmt = db::conn()->prepare("SELECT * FROM user WHERE username=:username");
        $stmt->bindValue(":username", $username, \PDO::PARAM_STR);
        $stmt->execute(); 
        $u = $stmt->fetchObject(self::class);

        return $u;
    }

}