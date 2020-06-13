<?php


class Database
{
    private $connection = null;
    private $config;



    public function __construct(array $config)
    {
        $this->config = $config;

        try {
            // set connection if database exists
            $this->connection = new PDO(
                "mysql:host={$config['db']['host']};dbname={$config['db']['db_name']}",
                $config['db']['user'],
                $config['db']['password']
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // create database if not exists
            $this->connection = new PDO("mysql:host={$config['db']['host']}",
                $config['db']['user'],
                $config['db']['password']);
            $this->connection->exec("CREATE DATABASE {$config['db']['db_name']}");

            // create tables: tasks & users, set admin
            $this->connection = new PDO(
                "mysql:host={$config['db']['host']};dbname={$config['db']['db_name']}",
                $config['db']['user'],
                $config['db']['password']
            );
            $this->connection->exec(
                "CREATE TABLE `users` (
                                  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  name VARCHAR(50),
                                  password VARCHAR(32)
                                  );
                           CREATE TABLE `tasks` (
                                  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                  user VARCHAR(50),
                                  email VARCHAR(50),
                                  content VARCHAR(500),
                                  is_done BOOLEAN,
                                  is_edited BOOLEAN
                                  );
                           INSERT INTO `users`(name, password) VALUES ('admin', md5('123'));        "
            );
        }
    }

    public function getData($pageNumber, $orderBy = '', $orderDirection = '')
    {
        $tasksPerPage = $this->config['pagination']['items'];

        $sqlQuery = "SELECT * FROM `tasks` ";
        if ($orderBy) {
            $sqlQuery .= "ORDER BY " . $orderBy;
            ($orderDirection === 'desc') ? $sqlQuery .= " DESC " : $sqlQuery .= " ASC ";
        }
        $sqlQuery .= "LIMIT " . $tasksPerPage;
        if ($pageNumber) $sqlQuery .= " OFFSET " . ($pageNumber - 1) * $tasksPerPage;

        $currentData = $this->connection->query($sqlQuery)->fetchAll();

        return $currentData;

    }

    public function getCountPages() {
        $sqlQuery = "SELECT COUNT(*) FROM `tasks` ";
        return ceil($this->connection->query($sqlQuery)->fetchColumn()/$this->config['pagination']['items']);
    }



}