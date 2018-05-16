<?php

include_once "Database/SQLBuilder.php";

class Model
{
    protected $tabel = null;
    public static $id_name = "id";
    private $isAutoinc;
    private $isNew;
    private $attributes = [];
    private $builder;

    function __construct($attributes = null, $new = false, $auto_inc = true)
    {
        $this->isAutoinc = $auto_inc;
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

        if($name=="id")
            $name = get_class($this)::$id_name;
        return $this->attributes[$name] ?? null;

    }

    function __set($name, $value)
    {

        if($this->attributes[$name]??null)
            $this->attributes[$name] = $value;
    }

    function get($count = null)
    {

        $recs = $this->builder->get($count);
        $models = [];
        foreach ($recs as $rec)
            //get_class($this);
            $models[] = new static($rec,false,false);
        return $models;
    }

    static function all()
    {
        return (new static())->get();
    }

    function save()
    {
        if (!$this->isNew)
        {
            $id_value = $this->attributes[self::$id_name];
            return $this->builder->where(self::$id_name."=$id_value")
                                 ->update($this->attributes);
        }
        else {
            $this->isNew = false;
            return $this->builder->insert($this->attributes);
        }
    }

    function get_attributes()
    {
        return $this->attributes;
    }

}
