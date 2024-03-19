<?php
session_start();

//print_r($_SESSION['user'] = "");

if(isset($_SESSION['user']))
{
    $mysqli = require "config/database_config.php";
    $sql="SELECT * FROM login WHERE Username='".$_SESSION['user']."'";
    $result=$mysqli->query($sql);
    $user=$result->fetch_assoc();
}
else
{
    $user = null;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asterics</title>
</head>
<body>
    <h1>Welcome to Asterics </h1>
    <?php if (isset($user)): ?>
        <p>Hello <?=htmlspecialchars( $user["Username"] )?></p>
        <p><a href="Logout.php">Logout</a></p>
    <?php else: ?>
        <p>You are not logged in</p>
        <a href="Login.php">Login</a> or <a href="Registration.php">Register</a>

    <?php endif; ?>
</body>
</html>