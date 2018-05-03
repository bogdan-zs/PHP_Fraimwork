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
    $exp_of_script = 10;
    $template = $template . ".php";
    $files = scandir($cache_path);
    $template_time = fileatime($templates_path . $template);
    $cache_time = fileatime($cache_path . $template);

    if (!in_array("$template", $files) || ($template_time - $cache_time) > $exp_of_script)
        parser($template);

    extract($context, EXTR_SKIP);
    ob_start();
    require "$app_name/templates/cache/$template";

    return ob_get_clean();
}


function parser($template)
{
    echo "parser";
    require "config.php";
    $file_path = "$app_name/templates/$template";

    $special_symbols = [
        "{!" => "<?=",
        "!}" => "?>",
        "{{" => "<?=htmlentities(",
        "}}" => ")?>",
        "{%" => "<?php",
        ":%}" => ":?>",
        "%}" => ";?>"
    ];

    $str = file_get_contents($file_path);


    foreach ($special_symbols as $symbol => $php_symbol)
        $str = str_replace($symbol, $php_symbol, $str);
    file_put_contents("$app_name/templates/cache/$template", $str);
    return $str;
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