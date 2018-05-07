<?php

include_once "Admin.php";
class Router
{
    private $paths;

    function __construct()
    {
        $this->paths = [];
    }

    function add_rout($path, $func, $middleware = null)
    {
        $path = preg_replace("/\\//", "\/", $path);
        $path = preg_replace("/\\^/", "/^\/", $path); //begin of string
//        $path = preg_replace("/\\$/", "$/", $path); //end string

        //$path = $path."\/(\?\S+?=\S+?)*?$/";
        $path = preg_replace("/\\$/", "\/(\?\S+?=\S+?)*?$/", $path); //end and query string

        if(!preg_match("/\\$/", $path)) // if dont have and of string
            $path = $path."\S*?\/(\?\S+?=\S+?)*?$/";

        $this->paths[$path] = preg_split("/\@/", $func); // [class,func,args]
        $this->paths[$path]["middleware"] = $middleware;

        $args = $this->paths[$path][2] ?? null;
        if ($args) {
            $args = preg_replace("/(\\(|\\))/", "", $args);
            $this->paths[$path][2] = preg_split("/,/", $args);
        }
        //echo $path;


    }

    function run()
    {
        $path_from_user = $_SERVER["REQUEST_URI"];
        foreach ($this->paths as $path => $view) {
            $values_from_uri = [];
            $params_view_func = [];
            if (preg_match($path, $path_from_user, $values_from_uri)) {

                $name_of_middlewares = array_merge([$view["middleware"]],$view[0]::$middleware);
                foreach ($name_of_middlewares as $middleware)
                    if($middleware)
                        $middlewares[] = new $middleware();

                $result = $this->middleware_run($middlewares);

                if ($result) {
                    if ($view[2] ?? false)
                        $params_view_func = $this->param_arr($view[2], $values_from_uri);

                    $req = call_user_func_array(array($view[0], $view[1]), $params_view_func);

                    echo $req;
                } else
                    foreach ($middlewares as $middleware)
                        $middleware->error();
                break;
            }
        }
    }
    function middleware_run($middlewares)
    {


        foreach ($middlewares as $middleware) {
            if ($middleware) {
                return $middleware->handle();
            } else
                return true;
        }

    }
    function param_arr($args, $reg_args)
    {
        $values = [];
        foreach ($args as $arg) {
            $values[] = $reg_args[$arg];
        }
        return $values;
    }
}

$Router = new Router();
function add_rout($path, $func, $middleware=null)
{
    global $Router;
    $Router->add_rout($path, $func, $middleware);
} //alias


require_once "config.php";
require_once "$APP_NAME/routes.php";
