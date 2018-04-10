<?php
/**
 * Created by PhpStorm.
 * User: bogdan
 * Date: 07.04.18
 * Time: 19:03
 */

include_once "Singleton.php";
class Database
{
    use Singleton;
    static private $DBH;

    static function connect()
    {
        require "../config.php";
        extract($config);

        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        return $DBH;
    }

    static function SQL($query)
    {
        $prepare_query = self::$DBH->prepare($query);
        $prepare_query->execute();
        return $prepare_query->fethcAll(PDO::FETCH_ASSOC);
    }
}


