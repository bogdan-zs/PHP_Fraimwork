<?php

include_once "Database/SQLBuilder.php";

class Model
{
    private $tabel = null;
    private $id_name = "id";
    private $isAutoinc;
    private $isNew;
    private $attributes = [];
    private $builder;

    function __construct($attributes = null, $new = false, $autoinc = true)
    {
        $this->isAutoinc = $autoinc;
        if (!$this->tabel) $this->tabel = strtolower(get_class($this));
        $this->attributes = $attributes;
        $this->builder = SQLBuilder::table($this->tabel);
        $this->isNew = $new;
    }

    function __call($name, $arguments)
    {

        $res = call_user_func_array(array($this->builder, $name), $arguments);
        if ($res instanceof SQLBuilder)
            return $this;
        return $res;
    }

    static function __callStatic($name, $arguments)
    {

        $model = new static();
        return call_user_func_array(array($model, $name), $arguments);
    }

    function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    function get($count = null)
    {
        if(!$this)
            return (new self())->get($count);
        $recs = $this->builder->get($count);
        $models = [];
        foreach ($recs as $rec)
            $models[] = new static($rec,false,false);
        return $models;
    }

    function save()
    {
        if ($this->isAutoinc) {

            $last_id = Database::connect()
                ->prepare("select $this->id_name from $this->tabel order by $this->id_name desc limit 1");
            $last_id->execute();
            $last_id = $last_id->fetch(PDO::FETCH_ASSOC);
            $last_id[$this->id_name] += 1;
            $this->attributes += $last_id;
        }

        if (!$this->isNew)
        {
            $id_value = $this->attributes[$this->id_name];
            return $this->builder->where("$this->id_name=$id_value")
                                 ->update($this->attributes);
        }
        else
            return $this->builder->insert($this->attributes);
    }

}
