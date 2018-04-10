<?php
class Get
{
    use Singleton;
    public function __get($name)
    {
        return $_GET[$name]??null;
    }
}

class Post
{
    use Singleton;
    public function __get($name)
    {
        return $_POST[$name]??null;
    }
}



class http
{
    use Singleton;

    static public function get()
    {
        return Get::getInstance();
    }

    static public function post()
    {
        return Post::getInstance();
    }

    public function __get($name)
    {
        return $_SERVER[$name]??null;
    }
}

