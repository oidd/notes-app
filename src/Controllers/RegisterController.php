<?php

namespace App\Controllers;

use App\Models\UserModel;

class RegisterController extends \App\Core\Controller
{
    public function index()
    {
        if ($this->isCredentialsProvided())
        {
            $u = new UserModel;
            $u->username = $_POST['username'];
            $u->hashedPassword = md5($_POST['password']);
            $u->save();
            self::redirect("login");
        }

        $this->proceedView("ttreg", array());
    }

    private function isCredentialsProvided() : bool
    {
        return isset($_POST['username']) && isset($_POST['password']);
    }
}