<?php
 include("config/database_config.php");

    $is_invalid = false;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $mysqli=require "config/database_config.php";
        $sql=sprintf(
            "SELECT * FROM login WHERE Username='%s' AND Password='%s'",
            $mysqli->real_escape_string($_POST["Username"]),
            $mysqli->real_escape_string($_POST["Password"])
        );
        $result=$mysqli->query($sql);

        $user=$result->fetch_assoc();

        var_dump($user);
        exit;
    }
    // if(isset($_POST['Username']) && isset($_POST['Password']))
    // {
    //     $Username=$_POST['Username'];
    //     $Password=$_POST['Password'];
    //     $sql="SELECT * FROM login WHERE Username='$Username' AND Password='$Password'";
    //     $result=$mysqli->query($sql);
    //     $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
    //     $count=mysqli_num_rows($result);
    //     if($count==1)
    //     {
    //         header("Location: welcome.php"); //redirect to file "welcome.php"
    //         die;
    //     }
    //     else
    //     {
    //         echo '<script> 
    //             window.location="Login.php";
    //             alert("Login Failed. Invalid Username or Password")
    //         </script>';
    //     }
    // }

?>


<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php /* if ($is_invalid) : ?>
        <em>Invalid login</em>
    <?php endif; */ ?>

    
    <div id="form">
    <h1>Login</h1>
        <form method="POST" action="Login.php" onsubmit="return isvalid()" novalidate>
        <div>
            <label for="Username">Enter Username:</label>
            <input type="text" id="Username" name="Username" required><br><br>
            </div>
            <div>
            <label for="Password">Enter Password:</label>
            <input type="Password" id="Password" name="Password" required><br><br>
            </div>
            <div>
            <input type="submit" id="btn" value="Login">
            </div>
        </form>
    </div>
    <script>
        function isvalid()
        {
            var Username=document.form.Username.value;
            var Password=document.form.Password.value;
            if(Username.length=="" && Password.length=="")
            {
                alert("Please enter Username and Password");
                return false;
            }
            else
            {
                if(Username.length=="")
                {
                    alert("Please enter Username");
                    return false;
                }
                if(Password.length=="")
                {
                    alert("Please enter Password");
                    return false;
                }
            }
            
        }
    </script>
</body>
</html>

