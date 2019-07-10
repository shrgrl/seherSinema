<?php
@session_start();
spl_autoload_register(function ($class) {
    if (file_exists('class/' . str_replace('\\', '/', $class) . '.class.php'))
        include 'class/' . str_replace('\\', '/', $class) . '.class.php';
});


require 'func.php';


$db = \Database\MySqlDb::getInstance();
$db->setup('localhost', 'sinema', 'root', '');
$db->connect();
$db->createAllTables();


