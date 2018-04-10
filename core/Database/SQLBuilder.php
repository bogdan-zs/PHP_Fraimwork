<?php

include_once "Singleton.php";
include_once "Database.php";

class SQLBuilder
{
    use Singleton;
    private static $table = null;
    private static $select = ["*"];
    private static $where = [];
    private static $orderBy = [];
    private static $DBH;

    static function connect()
    {
        self::$DBH = Database::connect();
    }

    static function table($table)
    {
        self::$table = $table;
        return self::getInstance();
    }

    static function select(...$columns)
    {

        self::$select = $columns;
        return self::getInstance();
    }

    static function where(...$conditions)
    {
        self::$where = [];
        foreach ($conditions as $condition) {
            self::$where[] = preg_split("/(\>\=|\<\=|\=|\>|\<)/",
                $condition, -1, PREG_SPLIT_DELIM_CAPTURE);
        }

        return self::getInstance();
    }

    static function orderBy(...$columns)
    {
        self::$orderBy = $columns;
        return self::getInstance();
    }

    static private function make_arr_for_plc($arr)
    {
        $result = [];
        self::$where = array();
        foreach ($arr as $el) {
            $result[] = "$el[0]$el[1]:$el[0]";
            self::$where[$el[0]] = $el[2];
        }

        return $result;
    }

    static function get($count = null)
    {
        $select_columns = join(",", self::$select);
        $table = self::$table;
        $where_condit = "";
        $order_by_columns = "";

        if (self::$where)
            $where_condit = "WHERE " . join(" and ",
                    self::make_arr_for_plc(self::$where));

        if (self::$orderBy)
            $order_by_columns = "ORDER BY " . join(",", self::$orderBy);

        if ($count)
            $count = "LIMIT $count";

        $query = "SELECT $select_columns FROM $table $where_condit $order_by_columns $count";

        $prepare_query = self::$DBH->prepare($query);
        $prepare_query->execute(self::$where);
        return $prepare_query->fetchAll(PDO::FETCH_ASSOC);

    }

    static function insert($atr)
    {
        $table = self::$table;
        $columns = join(",", array_keys($atr));
        $values = ":" . join(",:", array_keys($atr));
        $query = "INSERT INTO $table ($columns) VALUE ($values)";
        print $query;
        $status = self::$DBH->prepare($query)->execute($atr);
        return $status;
    }

    static function update($atrs)
    {
        $table = self::$table;
        $placeholder_for_set = [];

        if (self::$where)
            $where_condit = "WHERE " . join(" and ",
                    self::make_arr_for_plc(self::$where));
        else
            return false;


        foreach (array_keys($atrs) as $key)
            $placeholder_for_set[] = "$key=:$key";
        $placeholder_for_set = join(",", $placeholder_for_set);

        $query = "UPDATE $table SET $placeholder_for_set $where_condit";
        return self::$DBH->prepare($query)->execute($atrs + self::$where);
    }

    static function delete()
    {
        $table = self::$table;
        if (self::$where)
            $where_condit = "WHERE " . join(" and ",
                    self::make_arr_for_plc(self::$where));
        else
            return false;

        $query = "DELETE FROM $table $where_condit";
        return self::$DBH->prepare($query)->execute(self::$where);
    }
}
