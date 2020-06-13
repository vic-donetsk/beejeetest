<?php
include_once __DIR__ . '/core/Database.php';
include_once __DIR__ . '/core/Controller.php';
include_once __DIR__ . '/models/Task.php';

$config = include_once __DIR__ . '/config.php';

$db = new Database($config);
$controller = new Controller();



// routes


if (!isset($_GET['path']) && !count($_POST)) {
    // main page
    $controller->actionIndex();
}

 else if ($_GET['path'] === 'add') {
    // task's adding page
    $controller->actionCreate();
}

else if ($_GET['path'] === 'auth') {
    // authorization page
    var_dump('auth page');
}

else if ($_POST['path'] === 'done') {
    // mark the task as completed
    var_dump($_POST);
}

else if ($_POST['path'] === 'edited') {
    // mark the task as edited by admin
    var_dump($_POST);
}

else if ($_REQUEST['path'] === 'save') {
    // validate and append new task
    $controller->actionSave();
}

else



// URL and method not found
var_dump('404');


