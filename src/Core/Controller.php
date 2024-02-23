<?php

namespace App\Core;

abstract class Controller
{
    public abstract function index();

    protected static function isUserLogged()
    {
        return  isset($_SESSION['logged_user_id']) &&
                !empty($_SESSION['logged_user_id'])
                ;
    }

    protected static function redirect(string $to)
    {
        header("Location:$to");
        die();
    }

    protected static function refresh(int $in = 0)
    {
        header("Refresh:$in");
        die();
    }

    protected function proceedView(string $filename, array $viewData)
    {
        $elementsPath = "src/Views/Elements/";
        extract($viewData);
        require Config::$VIEWS_PATH . $filename . ".php";
        die();
    }
}