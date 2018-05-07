<?php



include_once "core/Model.php";
include_once "core/Database/SQLBuilder.php";
include_once "core/Database/Database.php";
include_once "core/Router.php";
include_once "core/http.php";
include_once "core/View.php";
include_once "core/Admin.php";
class Category extends Model
{

}
class Main{
    public static $middleware = [];
    static function index($id = null, $name = null)
    {
        //unset($_COOKIE["sessionid"]);

        return "yeap";
    }

}

$Router->run();

