<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends \App\Core\Controller
{
    public function index()
    {
        if ($this->isUserLoggedIn())
        {
            header("Location:/");
        }

        if ($this->isCredentialsHasBeenSent())
        {
            if (UserModel::isUserExists($_POST['username']))
            {
                if (UserModel::isUserPasswordMatches($_POST['username'], $_POST['password']))
                {
                    $_SESSION['logged_user_id'] = UserModel::getUserByUsername($_POST['username'])->getId(); 
                    header("Refresh:0");
                }
                $err[] = "incorrect password";
            }
            else
                $err[] = "this user doesn't exist";
        }

    }

    private function isUserLoggedIn() : bool
    {
        if (isset($_SESSION['logged_user_id']))
            return true;
        return false;
    }

    private function isCredentialsHasBeenSent() : bool
    {
        if (
            isset($_POST['username']) ||
            isset($_POST['password'])
        )
        return true;

        return false;
    }
}