<?php

namespace App\Models;

use \App\Core\Database as db;

class NoteModel extends \App\Core\ActiveRecordEntity
{
    public static function getTableName() : string
    {
        return 'note';
    }
}