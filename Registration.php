<?php
//session_start();    

require_once("config/database_config.php");

// $is_invalid = false;
// //check if the form is submitted
//    if ($_SERVER["REQUEST_METHOD"] === "POST") 
//    {
//    $mysqli = require "config/database_config.php";
    
//        $Firstname=$_POST['Firstname'];
//        $Lastname=$_POST['Lastname'];
//        $Email=$_POST['Email'];
//        $password=$_POST['password'];
//        $confirm_pass=$_POST['confirm_pass'];
    
         
//         // Check if email is already registered
//         $query = "SELECT * FROM users WHERE Email = '$Email'";
//         $result = mysqli_query($mysqli, $query);
//         if (mysqli_num_rows($result) > 0) {
//             echo "Email is already registered!";
//             header("Location: Registration.php?error=Email already exists!");
//             exit;
//         }
//             // Hash password
//             $hashed_password = password_hash($password, PASSWORD_DEFAULT);

//             // Insert user data into database
//             $query = "INSERT INTO users (Firstname, Lastname, Email, password) VALUES ('$Firstname','$Lastname', '$Email', '$hashed_password')";
//             if (mysqli_query($mysqli, $query)) {
//                 echo "User registered successfully!";
//             } else {
//                 echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
//             }

//             mysqli_close($mysqli);
//             header("Location: Login.php");
//             exit;
//     }       
?>



<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="UTF-8">
        <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
       <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <title>Registration Form |PHP</title>
        <script>
        // Function to clear input fields
        function clearFields() {
            document.getElementById("Email").value = "";
            document.getElementById("password").value = "";
        }
    </script>
    </head>
    <body onload="clearFields()"> <!-- Call the function onload to clear fields on page refresh -->
        <div>
            <?php
                
                ?>
        </div>
        <div id="form2">
            <form method="POST" action="success.php" onsubmit="clearFields()" novalidate> <!--Call the function onsubmit to clear fields on form submission-->
             <div class="container">
                    <div class="row">
                            
                        <div class="col-sm-3">
                            
                                <h1>SignUp</h1>
                                <hr class="mb-3">
                            
                            <div>
                                <label for="Firstname"><b>First Name:</b></label>
                                <input class="form-control"  type="text" id="Firstname" name="Firstname" required ><br><br>
                            </div>
                            <div>
                                <label for="Lastname"><b>Last Name:</b></label>
                                <input class="form-control" type="text" id="Lastname" name="Lastname" required ><br><br>
                            </div>
                            <div>
                                <label for="Email"><b>Enter Email:</b></label>
                                <input class="form-control" type="Email" id="Email" name="Email" required ><br><br>
                            </div>
                            <div>
                                <label for="password"><b>Enter Password:</b></label>
                                <input class="form-control" type="password" id="password" name="password" required ><br><br>
                            </div>  
                            <div>
                                <label for="confirm_pass"><b>Confirm_Password:</b></label>
                                <input class="form-control" type="password" id="confirm_pass" name="confirm_pass" required > <br><br>
                            </div>
                            <div>
                                <input class="btn btn-primary" type="submit" name="create" id="btn" value="Sign Up"><br><br>
                            </div>
                             <a href="Login.php">Click to Login</a>
                            </div>
                        </div>
                    </div>
                </div>        
            </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
           <script type="text/javascript">    
         $(function(){
            $('#btn').click(function(e){
                var valid= this.form.checkValidity();
                if(valid){
                    // var Firstname  = $('#Firstname').val();
                    // var Lastname   = $('#Lastname').val();
                    // var Email      = $('#Email').val();
                    // var password   = $('#password').val();
                    // var confirm_pass = $('#confirm_pass').val();


                    e.preventDefault();
                    var form=$(this).closest('form');
                    var formData=form.serializeArray();

                    $.ajax({
                                type:'POST',
                                url:'success.php',
                                data: formData,  //{Firstname:Firstname,Lastname:Lastname,Email:Email,password:password,confirm_pass:confirm_pass},
                                beforeSend: function() {
                    // Disable the button and change its text to "Processing..."
                    $('#btn').attr('disabled', true).html("Processing...");
                },
                                success:function(response){
                                    var response=JSON.parse(response);
                                    if(response.status=='success'){
                                    Swal.fire({
                                        'title': 'Welcome!',
                                        'text': result.message,
                                        'icon': 'success',
                                        'confirmButtonText': 'OK'
                                     }).then(function() {
                            // Reset the form after successful submission
                            form[0].reset();
                        });
                                     }else{
                                        Swal.fire({
                                        title: 'Error!',
                                        text: result.message,
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                        });
                                        }
                                    // Re-enable the button and restore its original text
                                    $('#btn').attr('disabled', false).html("Sign Up");
                                },
                                    error:function(XMLHttpRequest, textStatus, errorThrown){
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'There were errors while saving the data.',
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                      // Re-enable the button and restore its original text
                                        $('#btn').attr('disabled', false).html("Sign Up");  
                                    }
                  });
                }
            });

                    // var Firstname  = $('#Firstname').val();
                    // var Lastname   = $('#Lastname').val();
                    // var Email      = $('#Email').val();
                    // var password   = $('#password').val();
                    // var confirm_pass = $('#confirm_pass').val();
                    //});
                    
         });
            </script>

            
    <!-- <script>
        function validatePassword() {
            var password = document.getElementById('password').value;
            var confirm_pass = document.getElementById('confirm_pass').value;
            var wrong_pass_alert = document.getElementById('wrong_pass_alert');

            if (password !== confirm_pass) {
                wrong_pass_alert.style.color = 'red';
                wrong_pass_alert.innerHTML = '☒ Passwords do not match';
                document.getElementById('btn').disabled = true;
                document.getElementById('btn').style.opacity = 0.4;
                return false; // Prevent form submission
            } else {
                wrong_pass_alert.style.color = 'green';
                wrong_pass_alert.innerHTML = '🗹 Passwords match';
                document.getElementById('btn').disabled = false;
                document.getElementById('btn').style.opacity = 1;
                return true; // Allow form submission
            }
        }
    </script> -->
    </body>
</html>