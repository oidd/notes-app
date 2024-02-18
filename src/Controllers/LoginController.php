<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends \App\Core\Controller
{
    function __construct()
    {
        if ($this->isUserLogged())
            self::redirect('/note');
    }

    public function index()
    {
        if ($this->isCredentialsHasBeenSent())
        {
            if (UserModel::isUserExists($_POST['username']))
            {
                if (UserModel::isUserPasswordMatches($_POST['username'], $_POST['password']))
                {
                    $_SESSION['logged_user_id'] = UserModel::getUserByUsername($_POST['username'])->getId(); 
                    self::refresh();
                }
                $err[] = "incorrect password";
            }
            else
                $err[] = "this user doesn't exist";
        }

        $this->proceedView('loginView', array());
    }

    private function isCredentialsHasBeenSent() : bool
    {
        return  isset($_POST['username']) && !empty($_POST['username']) &&
                isset($_POST['password']) && !empty($_POST['password'])
                ;
    }
}