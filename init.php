<?php
error_reporting(E_ALL);

$db = mysqli_connect('localhost', 'root', '', 'doingsdone');

if (!$db) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

require_once('functions.php');
require_once('mysql_helper.php');
