<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\NoteModel;
use App\Models\UserModel;

class HomeController extends Controller 
{
    public function index()
    {
        $this->proceedView('homePage', array());
    }
}