<?php



include_once "core/Model.php";
include_once "core/Database/SQLBuilder.php";
include_once "core/Database/Database.php";
include_once "core/Router.php";
class Main{
    static function index($id = null, $name = null)
    {
        return "Hello rout $id $name {$_GET["q"]} {$_GET["q1"]}";//laba5\/$/
    }

}

$Router->add_rout("^laba5$","Main@index");
$Router->add_rout("^laba5/(?<id>\d+)/(?<name>\d+)$","Main@index@(id,name)");
$Router->run();
