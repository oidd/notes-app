<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\NoteModel;
use App\Models\UserModel;

class HomeController extends Controller 
{
    public function index()
    {}

    private function isUserLoggedId()
    {
        return  isset($_SESSION['logged_user_id']) &&
                !empty($_SESSION['logged_user_id'])
                ;
    }
}