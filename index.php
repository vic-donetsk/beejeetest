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
    var_dump('adding page');
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
    // mark the task as completed
    var_dump($_POST);
}

else if ($_POST['path'] === 'save') {
    // mark the task as completed
    var_dump($_POST);
}

else



// URL and method not found
var_dump('404');

//
//else if (count($_GET)) {
//    // pagination page
////    $controller->actionFiltration($_GET, $config['pagination']['items']);
//} else if (count()) {

//}

//require __DIR__ . '/views/index.view.php';
