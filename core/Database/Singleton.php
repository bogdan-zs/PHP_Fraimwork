<?php
/**
 * Created by PhpStorm.
 * User: bogdan
 * Date: 07.04.18
 * Time: 16:01
 */

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