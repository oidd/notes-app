<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends \App\Core\Controller
{
    public function index()
    {
        if ($this->isCredentialsHasBeenSent())
        {
            if (UserModel::isUserExists($_POST['username']))
            {
                if (UserModel::isUserPasswordMatches($_POST['username'], $_POST['password']))
                {
                    $_SESSION['logged_user_id'] = UserModel::getUserByUsername($_POST['username'])->getId(); 
                    self::redirect('/');
                }
                $err[] = "incorrect password";
            }
            else
                $err[] = "this user doesn't exist";
        }

        $this->proceedView('ttlogin', array());
    }

    private function isCredentialsHasBeenSent() : bool
    {
        return  isset($_POST['username']) && !empty($_POST['username']) &&
                isset($_POST['password']) && !empty($_POST['password'])
                ;
    }
}