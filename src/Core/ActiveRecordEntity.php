<?php

namespace App\Core;

use \App\Core\Database as db;

abstract class ActiveRecordEntity
{
    protected $id;

    abstract public static function getTableName() : string;

    public function getId()
    {
        return $this->id;
    }

    public function save()
    {
        $t = get_object_vars($this);
        unset($t['id']);
        $stmt = db::conn()->prepare("INSERT INTO " . static::getTableName() . " (" . implode(', ', array_keys($t)) . ") " ."VALUES " . "('" . implode("', '", array_values($t)) . "')");
        // todo: refactor this garbage
        $stmt->execute();
    }

    public static function findAll()
    {
        $stmt = db::conn()->prepare("SELECT * FROM :tableName");
        $stmt->bindValue(":tableName", static::getTableName());
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public static function findById(int $id)
    {
        $stmt = db::conn()->prepare("SELECT * FROM " . static::getTableName() . " WHERE id=:id");
        $stmt->bindValue(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject(static::class);
    }

    public static function findWhere(string $param)
    {
        $stmt = db::conn()->prepare("SELECT * FROM :tableName WHERE " . $param);
        $stmt->bindValue(":tableName", static::getTableName(), \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }
}