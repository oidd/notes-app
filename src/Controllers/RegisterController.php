<?php

namespace App\Controllers;

use App\Models\UserModel;

class RegisterController extends \App\Core\Controller
{
    public function index()
    {
        if (!$this->isCredentialsHasBeenSent())
        {
            $this->proceedView("ttreg", array());
        }

        if (!$this->isAllCredentialsHasBeenSent())
        {
            $viewData['err'] = 'Fill all inputs';
            $this->proceedView("ttreg", $viewData);
        }

        if ($_POST['password'] !== $_POST['passwordSubmit'])
        {
            $viewData['err'] = 'Passwords should be matching';
            $this->proceedView("ttreg", $viewData);
        }

        if (UserModel::isUserExists($_POST['username']))
        {
            $viewData['err'] = 'Account with this username is already exists';
            $this->proceedView("ttreg", $viewData);
        }

        $u = new UserModel;
        $u->username = $_POST['username'];
        $u->hashedPassword = md5($_POST['password']);
        $u->save();
        self::redirect("/logout");
    }

    private function isCredentialsHasBeenSent() : bool
    {
        return  isset($_POST['username']) || !empty($_POST['username']) ||
                isset($_POST['password']) || !empty($_POST['password']) ||
                isset($_POST['passwordSubmit']) || !empty($_POST['passwordSubmit'])
                ;
    }

    private function isAllCredentialsHasBeenSent() : bool
    {
        return  isset($_POST['username']) && !empty($_POST['username']) &&
                isset($_POST['password']) && !empty($_POST['password']) &&
                isset($_POST['passwordSubmit']) && !empty($_POST['passwordSubmit'])
                ;
    }
}