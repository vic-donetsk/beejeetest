<?php

class Task {

    public $fieldsList;
    public $validationLengthRules;
    public $db;

    public function __construct()
    {
        $this->fieldsList = [
            'user' => 'Пользователь',
            'email' => 'E-mail',
            'content' => 'Текст задачи',
            'is_done' => 'Статус'
        ];

        $this->validationLengthRules = [
            'user' => 50,
            'email' => 50,
            'content' => 250,
        ];

        $this->db = $GLOBALS['db'];
    }

    public function getCurrentPage($currentPage) {

        $currentOrderField = $_GET['orderBy'] ?? null;
        $currentOrderDirection = $_GET['direction'] ?? null;

        $tasks = $this->db->getData($currentPage, $currentOrderField, $currentOrderDirection);

        return $tasks;
    }

    public function setPagination(int $currentPage) {
        $totalPages = $this->db->getCountPages();

        if ($totalPages == 1) {
            return null;
        } else if ($totalPages > 4) {
            return $this->fullPagination($totalPages, $currentPage);
        } else {
            return $this->smallPagination($totalPages);
        }
    }

    private function smallPagination($totalPages) {
        $paginationArray = [];
        for ($i = 0; $i < $totalPages; $i++) {
            $paginationArray[] = $i + 1;
        }
        return $paginationArray;
    }

    private function fullPagination($totalPages, $currentPage) {

        switch($currentPage) {
            case 1:
                return [1, '..', $totalPages, 'Next'];
            case 2:
                return ['Prev', 1, 2, '..', $totalPages, 'Next'];
            case $totalPages - 1:
                return ['Prev', 1, '..', $totalPages-1, $totalPages, 'Next'];
            case $totalPages:
                return ['Prev', 1, '..', $totalPages];
            default:
                return ['Prev', 1, '..', $currentPage, '..', $totalPages, 'Next'];
        }
    }

    public function validation($inputData) {
        $errors = [];
        // check email format
        if (!filter_var($inputData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Неверный формат электронной почты';
        };
        foreach ($this->validationLengthRules as $field => $max) {
            // check for empty
            if (!$inputData[$field]) {
                $errors[$field] = 'Это поле должно быть заполнено!';
            }
            // check for max length
            if (strlen($inputData[$field]) > $max) {
                $errors[$field] = 'Длина поля - не более '. $max . ' символов';
            }
        }

        // updating or saving task
        if (!$errors) {
            if (isset($inputData['id'])) {
                $this->db->updateTask($inputData, $this->validationLengthRules);
            } else {
                $this->db->saveTask($inputData, $this->validationLengthRules);
            }
        }
        return $errors;
    }

    public function placeMarkDone($id) {
        $this->db->markDone($id);
    }

}
