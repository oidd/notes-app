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
            if (!$this->isAllCredentialsHasBeenSent())
            {
                $viewArgs['err'][] = 'Fill all the inputs';
                $this->proceedView('loginView', $viewArgs);
            }

            if (!UserModel::isUserExists($_POST['username']))
            {
                $viewArgs['err'] = 'Account with this username is not exists';                
                $this->proceedView('loginView', $viewArgs);
            }
            
            if (!UserModel::isUserPasswordMatches($_POST['username'], $_POST['password']))
            {
                $viewArgs['err'] = 'Incorrect password';
                $this->proceedView('loginView', $viewArgs);  
            }
            
            $_SESSION['logged_user_id'] = UserModel::getUserByUsername($_POST['username'])->getId(); 
            self::refresh();
        }

        $this->proceedView('loginView', array());
    }

    private function isCredentialsHasBeenSent() : bool
    {
        return  isset($_POST['username']) || !empty($_POST['username']) ||
                isset($_POST['password']) || !empty($_POST['password'])
                ;
    }

    private function isAllCredentialsHasBeenSent() : bool
    {
        return  isset($_POST['username']) && !empty($_POST['username']) &&
                isset($_POST['password']) && !empty($_POST['password'])
                ;
    }
}