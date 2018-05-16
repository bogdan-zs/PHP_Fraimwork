<?php
/**
 * Created by PhpStorm.
 * User: bogdan
 * Date: 05.05.18
 * Time: 18:26
 */
include_once "core/middleware.php";
include_once "Model.php";
include_once "Database/SQLBuilder.php";
$USER = [
    "admin" => hash("sha256", "password")
];

$TIME_LIFE_COOKIE = 300;

class AdminMiddleware implements Middleware
{
    private $errors;

    function check($login, $password)
    {
        global $USER;
        $hash_password = $USER[$login] ?? null;

        return $hash_password == hash("sha256", $password);
    }

    function handle()
    {
        global $TIME_LIFE_COOKIE;
        $query = $_GET["q"] ?? "";
        if ($query == "exit") {
            setcookie("sessionid", "", time() - 3600, "/");
            header("Location: .", true, 302);
        }

        $sessionid = $_COOKIE["sessionid"] ?? null;

        if ($sessionid == "123")
            return true;
        else {
            $login = $_POST["login"] ?? null;
            $password = $_POST["password"] ?? null;

            if (!$password || !$login) {
                echo render("admin");
                exit();
            }

            if ($this->check($login, $password))
                setcookie("sessionid", "123", time() + $TIME_LIFE_COOKIE, "/");
            header("Location: " . $_SERVER["REQUEST_URI"], true, 302);
            exit();

        }
    }

    function error()
    {
        header("Location: " . $_SERVER["REQUEST_URI"], true, 302);
        exit();
    }

}
require "config.php";

class Admin
{
    static public $middleware = ["AdminMiddleware"];
    //static public $middleware = [];


    static function index()
    {
        require "config.php";
        return render("admin_tables", ["tables" => $ADMIN_CLASSES]);
    }

    static function show($table)
    {
        global $ADMIN_CLASSES;
        if(in_array($table, $ADMIN_CLASSES)) {
            $records = $table::all();
            $keys = SQLBuilder::get_columns_name(strtolower($table));
            return render("table", [
                "records" => $records,
                "table" => $table,
                "keys" => $keys]);
        }
    }

    static function edit($table, $id)
    {
        global $ADMIN_CLASSES;
        if(in_array($table, $ADMIN_CLASSES)) {
            if ($_SERVER["REQUEST_METHOD"] == "POST")
                self::save_edit($table, $id);

            $record = $table::where($table::$id_name . "=$id")->get()[0]->get_attributes();
            $input_types = self::input_types($table);
            $record_types = array_combine($record, $input_types);
            return render("record", ["record_types" => $record_types, "record" => $record, "table" => $table]);
        }
    }

    static private function save_edit($table, $id)
    {
        $table::where($table::$id_name . "=$id")->update($_POST);
        header("Location: ..", true, 301);
        exit();
    }

    static private function input_types($table)
    {
        $table = strtolower($table);
        $types = SQLBuilder::get_columns_type($table);
        require_once "config.php";
        global $TYPES_INPUT;
        foreach ($types as $type)
            $input_types[] = $TYPES_INPUT[$type];
        return $input_types;
    }

    static function add($table)
    {
        global $ADMIN_CLASSES;
        if(in_array($table, $ADMIN_CLASSES)) {
            if ($_SERVER["REQUEST_METHOD"] == "POST")
                self::save_add($table);
            $input_types = self::input_types($table);
            $labels = SQLBuilder::get_columns_name(strtolower($table));
            $labels_types = array_combine($labels, $input_types);
            return render("add", ["labels_types" => $labels_types, "table" => $table]);
        }

    }

    static private function save_add($table)
    {
        if (!$_POST[$table::$id_name])
            unset($_POST[$table::$id_name]);
        var_dump($_POST);
        $table::insert($_POST);
        header("Location: ..", true, 301);
        exit();
    }

    static public function delete($table, $id)
    {
        global $ADMIN_CLASSES;
        if(in_array($table, $ADMIN_CLASSES)) {
            $table::where($table::$id_name . "=$id")->delete();
            header("Location: ../..", true, 301);
            exit();
        }
    }
}
