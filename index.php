<?php



include_once "core/Model.php";
include_once "core/Database/SQLBuilder.php";
include_once "core/Database/Database.php";
include_once "core/Router.php";
include_once "core/http.php";
include_once "core/View.php";
class Category extends Model
{

}
class Main{
    static function index($id = null, $name = null)
    {
        $categorys = Category::all();
        return render("main",["arr"=>$categorys]);
    }

}

$Router->run();
