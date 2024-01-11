<?php

function connection()
{
    $host = 'localhost';
    $port = '3306';
    $database = 'point_of_sales';
    $username = 'root';
    $password = '';

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}