<?php
session_start();    

include("config/database_config.php");


//check if the form is submitted
   if ($_SERVER["REQUEST_METHOD"] === "POST") 
   {
   
       $Username=$_POST['Username'];
       $Email=$_POST['Email'];
       $Password=$_POST['password'];
       $Confirm_Password=$_POST['Confirm Password'];
           //check if password and confirm password match
         if($Password !== $Confirm_Password){
              echo "Passwords do not match";
              exit;
         }
         
        // Check if email is already registered
        $query = "SELECT * FROM users WHERE Email = '$Email'";
        $result = mysqli_query($mysqli, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "Email is already registered!";
            exit;
        }
            // Hash password
            $hashed_password = password_hash($Password, PASSWORD_DEFAULT);

            // Insert user data into database
            $query = "INSERT INTO users (Username, Email, password) VALUES ('$Username', '$Email', '$hashed_password')";
            if (mysqli_query($mysqli, $query)) {
                echo "User registered successfully!";
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
            }

            mysqli_close($mysqli);
            header("Location: Login.php");
            exit;
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
                <input type="password" id="password" name="password" required><br><br>
            </div>  
            <div>
                <label for="Confirm Password">Confirm_Password:</label>
                <input type="Password" id="Confirm Password" name="Confirm Password" required> <br><br>
            </div>
            <div>
            <input type="submit" id="btn" value="SignUp"><br><br>
        </div>
        <a href="Login.php">Click to Login</a>
        </form>
    </body>
</html>