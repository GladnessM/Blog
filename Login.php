<?php
session_start();
//  include("config/database_config.php");
//  $is_invalid = false;
// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // If the user is already logged in, redirect to the dashboard or home page
    header("Location: welcome.php");
    exit;
 }

//  //check if the form is submitted
//  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Email"]) && isset($_POST["password"])) {
//     $email = $_POST["Email"];
//     $password = $_POST["password"];

//     // Fetch user data from database
//     $query = "SELECT * FROM users WHERE Username = '$email' and password='$password'";
//     $result = mysqli_query($mysqli, $query);
//     if (mysqli_num_rows($result) == 1) {
//         $user = mysqli_fetch_assoc($result);
//         // Verify password
//         if (isset($user['password']) && password_verify($password, $user['password'])) {
//             // Password is correct, set session variables
//             $_SESSION['user_id'] = $user['id'];
//             $_SESSION['username'] = $user['username'];
//             // Redirect to welcome page
//             header("Location: welcome.php");
//             exit;
//         } else {
//             echo "Invalid password!";
//         }
//     } else {
//         echo "User not found!";
//     }
// } else{
//         header("Location: Login.php");
//         exit;
//     }
    
//     $is_invalid=true;
//     mysqli_close($mysqli);

     $is_invalid = false; 
     if($_SERVER["REQUEST_METHOD"] === "POST") //check if the form is submitted
     {
         $mysqli=require "config/database_config.php";
         $sql=sprintf(
             "SELECT * FROM users WHERE Email='%s' AND password='%s'", //fetch user data from database
         $mysqli->real_escape_string($_POST["Email"]), 
             $mysqli->real_escape_string($_POST["password"])
         );
         $result=$mysqli->query($sql);

         $user=$result->fetch_assoc(); 

         if($user) //if user is found
         {
            if(password_verify($_POST['password'], $user['password'])) //if password is correct
            {
                 session_start(); 
                 session_regenerate_id(); 
                 $_SESSION['user']=$user['Email']; 
           
           
              header("Location: welcome.php");
                exit;
            }
         }
           
                $is_invalid=true;
     }
          
?>   



<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        // Function to clear input fields
        function clearFields() {
            document.getElementById("Email").value = "";
            document.getElementById("password").value = "";
        }
    </script>
</head>
<body onload="clearFields()">
    
        <?php if ($is_invalid) : ?>
            <em>Invalid login</em>
          <?php endif;  ?>
    

    
    <div id="form">
    <h1>Login</h1>
        <form method="POST" action="Login.php" onsubmit="return isvalid()" novalidate >
        <div>
            <label for="Email">Enter Email:</label>
            <input type="Email" id="Email" name="Email" value="<?=htmlspecialchars($_POST["Username"] ?? "")?>" required autocomplete="off"><br><br>
            </div>
            <div>
            <label for="Password">Enter Password:</label>
            <input type="password" id="password" name="password" required autocomplete="off"><br><br>
            </div>
            <div>
            <input type="submit" id="btn" value="Login"><br><br>
            </div>
            <a href="Registration.php">Click to Register</a>
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

