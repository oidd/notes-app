<?php

namespace App\Models;

use \App\Core\Database as db;

class NoteModel extends \App\Core\ActiveRecordEntity
{
    public $title;
    public $data;
    public $user_id;

    public static function getTableName() : string
    {
        return 'note';
    }

    public static function getNotesByUserId(int $id)
    {
        return self::findWhere("user_id={$id}");
    }
}