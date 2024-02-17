<?php

namespace App\Core;

class Core
{
    public static function run() : void
    {
        $url        = self::getURL();
        $controller = self::getController($url);
        $action     = self::getAction($url);
        $params     = self::getParam($url);

        if (!self::ifControllerExists($controller))
        {
            echo "404 not found";
            die();
        }

        if (!self::ifActionExists($controller, $action))
            $action = 'index';

    
        $t = self::getControllerFullName($controller);
        $c = new $t;
        
        call_user_func_array([$c, $action], $params);
    }

    private static function getURL()
    {
        return '/' . $_GET['url'];
    }

    private static function getController(string $url)
    {
        if ($url == '/')
            return 'Home';

        $t = explode('/', $url);
        array_shift($t);

        if (isset($t[0]))
            return $t[0];
    }

    private static function getAction(string $url)
    {
        if ($url == '/')
            return 'index';

        $t = explode('/', $url);
        array_shift($t);

        if (isset($t[0]))
            array_shift($t);

        if (isset($t[0]))
            return $t[0];
        
        return 'index';
    }

    private static function getParam(string $url)
    {
        if ($url == '/')
            return array();

        $t = explode('/', $url);
        array_shift($t);

        if (isset($t[0]))
            array_shift($t);

        if (isset($t[0]))
            array_shift($t);

        if (isset($t[0]) && !empty($t[0]))
            return $t;

        return array();
    }

    private static function getControllerFullName(string $controller)
    {
        return "\\App\\Controllers\\" . ucfirst($controller) . 'Controller';
    }

    private static function ifControllerExists(string $controller)
    {
        return file_exists(Config::$CONTROLLERS_PATH . ucfirst($controller) . 'Controller.php');
    }

    private static function ifActionExists(string $controller, string $action)
    {
        return method_exists(self::getControllerFullName($controller), $action);
    }
}
