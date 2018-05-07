# PHP_Fraimwork

## Install
add file ```config.php```
config.php
```
<?php
$CONFIG = [
    "host" => "localhost:3306",
    "dbname" => "store",
    "user" => "root",
    "password" => "root"
];

$APP_NAME = "app";

$TEMPLATES_NAME = "$APP_NAME/templates/";

$CACHES_PATH = $TEMPLATES_NAME . "cache/";

$SECRET_KEY = "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855";

$ADMIN_TABLES = [
    "category",
    "client",
    "good",
    "source"
];

$TYPES_INPUT =
    [
        "int(11)" => "number",
        "double" => '"number" step="0.01"',
        "decimal(16,2)" => '"number" step="0.01"',
        "decimal(18,2)" => '"number" step="0.01"',
        "float" => '"number" step="0.01"',
        "datetime" => '"datetime"',
        "varchar(255)" =>'"text"',
        "varchar(45)" => '"text" maxlength="45"'
    ];
```
