<?php

/**
 * Settings for database and pagination
 *
 * @param String host     host name
 * @param String db_name  database name
 * @param String user     database user name
 * @param String password database user password
 * @param String items    tasks per page
 */

return [
    'db' => [
        'host'     => 'localhost',
        'db_name'  => 'beejee',
        'user'     => 'root',
        'password' => ''
    ],
    'pagination'       => [
        'items' => 1
    ]
];
