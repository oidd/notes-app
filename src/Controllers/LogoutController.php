<?php

namespace App\Controllers;

class LogoutController extends \App\Core\Controller
{
    public function index()
    {
        session_destroy();
        self::redirect('/');
    }
}