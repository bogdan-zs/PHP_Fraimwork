<?php



include_once "core/Model.php";
include_once "core/Database/SQLBuilder.php";
include_once "core/Database/Database.php";
include_once "core/Router.php";
include_once "core/http.php";
class Main{
    static function index($id = null, $name = null)
    {
        $q = http::get()->q;
        return "Hello rout $id $name {$q}";//laba5\/$/
    }

}
$Router->add_rout("^PHP_Fraimwork$","Main@index");
$Router->add_rout("^PHP_Fraimwork/(?<id>\d+)/(?<name>\d+)$","Main@index@(id,name)");
$Router->run();
