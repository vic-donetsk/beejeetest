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
        $model = new Task();

        $currentPageNumber = $_GET['page'] ?? 1;

        $currentPageTasks = $model->getCurrentPage($currentPageNumber);
        $currentPagination = $model->setPagination($currentPageNumber);

        require __DIR__ . '/../views/index.view.php';
    }

    public function actionCreate()
    {
        require __DIR__ . '/../views/add.view.php';
    }

}
