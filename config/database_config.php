<?php

$host = "localhost";
$dbname = "Blog-DB";
$username= "root";
$password = "";

$mysqli= new mysqli(
    hostname:$host,
    database:$dbname,
    username:$username,
    password:$password
);

if($mysqli->connect_error)
{
    die("Connection Error: ". $mysqli->connect_error);
}

return $mysqli;