<?php

/**
 * Created by PhpStorm.
 * User: bogdan
 * Date: 05.05.18
 * Time: 18:53
 */
class CrsfMiddleware implements Middleware
{
    public function handle()
    {
        require_once "config.php";
        $csrf_token = hash("sha256", $SECRET_KEY);
        if ($_SERVER["REQUEST_METHOD"]=="POST")
            return ($_POST["csrftoken"] ?? null) == $csrf_token;
        else
            return true;
    }

    public function error()
    {
        // TODO: Implement error() method.
    }
}