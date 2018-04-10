<?php


class Router
{
    private $paths = [];

    function __construct()
    {
        $this->paths = [];
    }

    function add_rout($path, $func)
    {
        $path = preg_replace("/\\//", "\/", $path);
        $path = preg_replace("/\\^/", "/^\/", $path);
        $path = preg_replace("/\\$/", "\/(\S+=\S+$)*/", $path);
        $this->paths[$path] = $func;
       // echo $path."<br>";
    }

    function run()
    {
        $path_from_user = $_SERVER["REQUEST_URI"];
        foreach ($this->paths as $path => $func) {
            $arguments = [];
            $values = [];
            if (preg_match($path, $path_from_user, $arguments)) {
                $class_func_args = preg_split("/\@/", $func);// [class,func,args]
                if ($class_func_args[2]??null)
                    $values = $this->value_args($class_func_args[2], $arguments);
                $req = call_user_func_array(array($class_func_args[0], $class_func_args[1]),
                    $values);

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
