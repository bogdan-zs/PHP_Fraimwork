<?php


trait Singleton
{
    private static $instance = null;
    private function __construct()
    {
    }
    private function __clone()
    {
    }

    static public function getInstance()
    {
        if(self::$instance)
            return self::$instance;
        else {
            self::$instance = new self();
            return self::$instance;
        }
    }
}
