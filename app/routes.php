<?php
$Router->add_rout("^PHP_Fraimwork$","Main@index");
$Router->add_rout("^PHP_Fraimwork/(?<id>\d+)/(?<name>\d+)$","Main@index@(id,name)");