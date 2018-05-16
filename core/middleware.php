<?php
/**
 * Created by PhpStorm.
 * User: bogdan
 * Date: 05.05.18
 * Time: 21:51
 */
interface Middleware
{
    function handle(); // run before all requests
    function error(); // run if handle() return false
}