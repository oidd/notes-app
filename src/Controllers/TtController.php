<?php

namespace App\Controllers;

use App\Models\NoteModel;
use App\Models\UserModel;

class TtController extends \App\Core\Controller
{
    public function index()
    {
        var_dump(UserModel::isUserExists('ebb'));
    }
}