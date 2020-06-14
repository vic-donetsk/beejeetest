<?php

class User
{
    private $db;
    private $admin;

    public function __construct()
    {
        $this->db = $this->db = $GLOBALS['db'];

        $this->admin = $this->db->getAdmin();
    }

    private function isAdmin($login, $password)
    {
        return ($login === $this->admin['name'] and md5($password) === $this->admin['password'])
            ? true
            : false;
    }

    public function validation($inputData)
    {
        $errors = [];
        $fields = ['login', 'password'];

        // check for empty
        foreach ($fields as $field) {
            if (!$inputData[$field]) {
                $errors[$field] = 'Это поле должно быть заполнено!';
            }
        }
        if ($errors) return $errors;

        // check user's auth data
        if (!$this->isAdmin($inputData['login'], $inputData['password'])) {
            $errors['login'] = 'Неверное имя пользователя или пароль';
        }

        return $errors;
    }


}
