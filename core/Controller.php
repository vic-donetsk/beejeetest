<?php

class Controller
{
    private $db;
    public $adminToken;

    function __construct()
    {
        $config = include_once __DIR__ . '/../config.php';

        $this->db = isset($GLOBALS['db'])
            ? $GLOBALS['db']
            : new DB($config);

        session_save_path(__DIR__ . '/../sessions/');
        session_start();
        $this->adminToken = $_SESSION['token'] ?? null;
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
        $_SESSION['previousPage'] = $_SERVER['HTTP_REFERER'];

        require __DIR__ . '/../views/add.view.php';
    }

    public function actionEdit()
    {
        $_SESSION['previousPage'] = $_SERVER['HTTP_REFERER'];

        $editedTask = $this->db->getOneTask($_GET['id']);

        require __DIR__ . '/../views/add.view.php';
    }

    public function actionSave()
    {
        if (isset($_POST['id']) and $_POST['token'] !== $_SESSION['token']) {
            echo json_encode(['declined' => true]);
            return;
        }

        $taskModel = new Task();
        $errors = $taskModel->validation($_POST);

        if ($errors) {
            // return validation errors
            echo json_encode($errors);
        } else {
            $link = $_SESSION['previousPage'] ?? '/';
            unset($_SESSION['previousPage']);
            echo json_encode(['location' => $link]);
        }
        return;
    }

    public function actionAuthenticate()
    {
        // save path to return only for
        // index page with get-parameters
        if (parseRouteFromUrl($_SERVER['HTTP_REFERER']) !== 'edit') {
            $_SESSION['previousPage'] = $_SERVER['HTTP_REFERER'];
        }
        require __DIR__ . '/../views/auth.view.php';
    }

    public function actionLogin()
    {
        $newUser = new User();

        $errors = $newUser->validation($_POST);

        if ($errors) {
            // return validation errors
            echo json_encode($errors);
        } else {
            // authentication successful

            // generate token for admin
            $token = random_bytes(15);
            $_SESSION['token'] = bin2hex($token);

            // return to page prior to authorization
            $link = $_SESSION['previousPage'] ?? '/';
            unset($_SESSION['previousPage']);
            echo json_encode(['location' => $link]);
        }
        return;
    }

    public function actionLogout()
    {
        unset($_SESSION['token']);
    }

    public function actionDone()
    {
        if ($_POST['token'] === $_SESSION['token']) {
            $doneTask = new Task();
            $doneTask->placeMarkDone($_POST['id']);
            echo json_encode(['accepted' => true]);
        } else {
            echo json_encode(['accepted' => false]);
        }
    }



}
