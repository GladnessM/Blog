<?php

    $host = "localhost";
    $dbname = "blog-db";
    $username= "root";
    $password = "";

    $mysqli= new mysqli(
        $host,
        $username,
        $password,
        $dbname
    );

    if($mysqli->connect_error)
    {
        die("Connection Error: ". $mysqli->connect_error);
    }
    echo "Connected successfully";

    return $mysqli;
?>