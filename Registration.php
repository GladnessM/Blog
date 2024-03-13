<?php
include("config/database_config.php");

   if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
       $Username=$_POST['Username'];
       $Email=$_POST['Email'];
       $Password=$_POST['Password'];
       $Confirm_Password=$_POST['Confirm_Password'];

       if(
        !empty($Username) && !empty($Email) && !empty($Password) && !empty($Confirm_Password) && !is_numeric($Username))
       
       {
        "INSERT INTO registration (Username, Email, Password, Confirm_Password) VALUES ('$Username', '$Email', '$Password', '$Confirm_Password')"
            mysqli_query($query);
            header("Location: Login.php");
            die;
       }else{
          header("Location: Registration.php");   
        echo "Please enter valid information in all the fields";
       }


   
    //    $sql = sprintf(
    //        "SELECT * FROM Info WHERE email = '%s'",
    //        $mysqli->real_escape_string($_POST["email"])
    //    );
   
    //    $result = $mysqli->query($sql);
   
    //    $user = $result->fetch_assoc();
   
    //    var_dump($user);
    //    exit;
   }
   
   
?>



<!DOCTYPE html>
<html lang="eng">
    <head>
        <title>Registration Form</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div id="form2">
        <h1>SignUp</h1>
        <form method="POST" action="Registration.php">
            <div>
                <label for="Username">Enter Username:</label>
                <input type="text" id="Username" name="Username" required><br><br>
            </div>
            <div>
                <label for="Email">Enter Email:</label>
                <input type="Email" id="Email" name="Email" required><br><br>
            </div>
            <div>
                <label for="Password">Enter Password:</label>
                <input type="Password" id="Password" name="Password" required><br><br>
            </div>  
            <div>
                <label for="Confirm Password">Confirm_Password:</label>
                <input type="Password" id="Confirm Password" name="Confirm  Password" required> <br><br>
            </div>
            <div>
            <input type="submit" id="btn" value="Register">
        </div>
        </form>
    </body>
</html>