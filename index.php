<?php
include_once __DIR__ . '/core/Database.php';
include_once __DIR__ . '/core/Controller.php';
include_once __DIR__ . '/core/helpers.php';
include_once __DIR__ . '/models/Task.php';
include_once __DIR__ . '/models/User.php';

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

 else if ($_GET['path'] === 'edit') {
    // edit page (admin mode)
    $controller->actionEdit();
}

else if ($_GET['path'] === 'auth') {
    // authorization page
    $controller->actionAuthenticate();
}

else if ($_REQUEST['path'] === 'done') {
    // mark the task as completed
    $controller->actionDone();
}

else if ($_REQUEST['path'] === 'save') {
    // validate and append new/update existing task
    $controller->actionSave();
}

else if ($_REQUEST['path'] === 'login') {
    // login for admin
    $controller->actionLogin();
}

else if ($_REQUEST['path'] === 'logout') {
    // logout for admin
    $controller->actionLogout();
}
else
    // URL and method not found
    $controller->action404();



