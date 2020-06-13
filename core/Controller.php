<?php

class Controller
{
    private $db;

    function __construct()
    {
        $config = include_once __DIR__ . '/../config.php';

        $this->db = isset($GLOBALS['db'])
            ? $GLOBALS['db']
            : new DB($config);
    }

    public function actionIndex()
    {
        $taskModel = new Task();

        $currentPageNumber = $_GET['page'] ?? 1;

        $currentPageTasks = $taskModel->getCurrentPage($currentPageNumber);
        $currentPagination = $taskModel->setPagination($currentPageNumber);

        require __DIR__ . '/../views/index.view.php';
    }

    public function actionCreate()
    {
        require __DIR__ . '/../views/add.view.php';
    }

    public function actionSave()
    {
        $taskModel = new Task();
        $errors = $taskModel->validation($_POST);

        if ($errors) {
            // return validation errors
            echo json_encode($errors);
        } else {
            echo 'ok';
        }
        return;
    }

}
