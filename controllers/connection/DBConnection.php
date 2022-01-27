<?php

function initConectionDB()
{
    $user = 'root';
    $password = 'root';
    $db = 'actividad1';
    $host = 'localhost';
    $port = 3306;

    $mysqli = @new mysqli(
        $host,
        $user,
        $password,
        $db
    );

    if ($mysqli->connect_error) {
        die('Error: ' . $mysqli->connect_error);
    }
    return $mysqli;
}

function error($mysqli)
{
    return 'Error: ' . $mysqli->error;
}