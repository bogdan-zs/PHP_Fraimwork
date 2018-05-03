<?php


class Router
{
    private $paths;

    function __construct()
    {
        $this->paths = [];
    }

    function add_rout($path, $func)
    {
        $path = preg_replace("/\\//", "\/", $path);
        $path = preg_replace("/\\^/", "/^\/", $path); //begin of string
        $path = preg_replace("/\\$/", "\/(\?\S+?=\S+?)*?$/", $path); // end string + query string
        $this->paths[$path] = preg_split("/\@/", $func); // [class,func,args]
    }

    function run()
    {
        $path_from_user = $_SERVER["REQUEST_URI"];
        foreach ($this->paths as $path => $view) {
            $arguments = [];
            $values = [];
            if (preg_match($path, $path_from_user, $arguments)) {
                if ($view[2]??false)
                    $values = $this->value_args($view[2], $arguments);

                $req = call_user_func_array(array($view[0], $view[1]), $values);

                echo $req;
            }
        }
    }

    function value_args($args, $reg_args)
    {
        $args = preg_replace("/(\\(|\\))/", "", $args);
        $args = preg_split("/,/", $args);
        $values = [];
        foreach ($args as $arg) {
            $values[] = $reg_args[$arg];
        }
        return $values;
    }
}

$Router = new Router();
require_once "config.php";
require_once "$app_name/routes.php";
