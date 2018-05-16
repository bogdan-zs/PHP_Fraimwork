<?php



include_once "core/Model.php";
include_once "core/Database/SQLBuilder.php";
include_once "core/Database/Database.php";
include_once "core/Router.php";
include_once "core/http.php";
include_once "core/View.php";
include_once "core/Admin.php";
class Fp extends Model
{
    static $id_name = "fp_id";
}

class Exams extends Model
{
    static $id_name = "exam_id";
}

class Students extends Model
{
    static $id_name = "student_id";
}
class Main{
    public static $middleware = [];
    static function index($id = null, $name = null)
    {
//        //echo $_GET["q"]=="del"?"true":"false"."<br>";
//        if(($_GET["q"]??null)=="set") {
//            echo "set<br>";
//            setcookie("test", "456");
//        }
//        elseif($_GET["q"]=="del") {
//            echo "del<br>";
//            setcookie("test", "", time() - 3600);
//            header("Location: .", true, 301);
//
//        }
//
//            echo $_COOKIE["test"]??"null"."<br>";
        //setcookie("sessionid", "", time() - 3600, "/");
       // echo $_COOKIE["sessionid"]. "***";
        echo preg_match("~^/PHP_Fraimwork/(\?\S+?=\S*?)*?~", "/PHP_Fraimwork/");
        //return "yeap";
    }

}



$Router->run();

