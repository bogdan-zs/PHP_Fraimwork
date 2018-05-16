<?php
/**
 * Created by PhpStorm.
 * User: bogdan
 * Date: 02.05.18
 * Time: 22:58
 */


function render($template, $context = [])
{
    require "config.php";
    $exp_of_script = 0;
    $template = $template . ".php";
    $files = scandir($CACHES_PATH);

    if (!in_array("$template", $files) ||
        (fileatime($TEMPLATES_NAME . $template) - fileatime($CACHES_PATH . $template)) > $exp_of_script) {
        parser($template);
    }

    extract($context, EXTR_SKIP);
    ob_start();
    require "$APP_NAME/templates/cache/$template";

    return ob_get_clean();
}


function parser($template)
{
    echo "parser";
    require "config.php";
    $file_path = "$APP_NAME/templates/$template";

    $special_symbols = [
        "{!" => "<?=",
        "!}" => "?>",
        "{{" => "<?=htmlentities(",
        "}}" => ")?>",
        "{%" => "<?php  ",
        ":%}" => ":?>",
        "%}" => ";?>"
    ];

    $str = file_get_contents($file_path);
  //  $str = csrf($str);

    foreach ($special_symbols as $symbol => $php_symbol)
        $str = str_replace($symbol, $php_symbol, $str);
    file_put_contents("$APP_NAME/templates/cache/$template", $str);
    return $str;
}

function csrf($text)
{
    require "config.php";
    $csrf_token = hash("sha256", $SECRET_KEY);
    $csrf_input = "<input type='hidden' name='csrftoken' value='$csrf_token' />";
    $text = str_replace("{%csrf%}", $csrf_input, $text);
    return $text;
}

//function parser_func($text)
//{
//    $special_func = [
//        "/\{\{(\\$(\w|_)+(\-\>(\w|_)+)?)\}\}/" => "htmlentities"
//    ];
//    $arg = [];
//    foreach ($special_func as $pattern => $func)
//        if (preg_match($pattern, $text, $arg)) {
//            var_dump($arg);
//            preg_replace($pattern, "{{ $func($arg[1])}}", $text);
//        }
//    echo $text;
//    return $text;
//}

