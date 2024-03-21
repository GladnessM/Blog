<?php
require_once("config/database_config.php");

// Enable error reporting for mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

 try{
    if(isset($_POST['create'])){
    $Firstname=trim ($_POST['Firstname']);
    $Lastname=trim ($_POST['Lastname']);
    $Email=trim ($_POST['Email']);
    $password= ($_POST['password']);
    $confirm_pass= ($_POST['confirm_pass']);

    // Validate email
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email format';
        header("Location: Registration.php");
        exit;
    }


    // Check if any of the fields are empty
    if(empty($Firstname) || empty($Lastname) || empty($Email) || empty($password) || empty($confirm_pass)){
        echo 'All fields are required.';
        header("Location: Registration.php");
        exit;
    }
    // Additional check to ensure passwords match
    if($password !== $confirm_pass){
        echo 'Passwords do not match.';
        header("Location: Registration.php");
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists in the database
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE Email=?");
    $stmt->bind_param('s', $Email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo 'Email is already registered!';
        header("Location: Registration.php");
        exit;
    }

    $sql="INSERT INTO users (Firstname, Lastname, Email, password, confirm_pass) VALUES (?,?,?,?,?)";
    $stmtinsert=$mysqli->prepare($sql);

    // Bind parameters to the prepared statement
    $stmtinsert->bind_param('sssss', $Firstname, $Lastname, $Email, $password, $confirm_pass);
    $result=$stmtinsert->execute();

   // $result=$stmtinsert->execute([$Firstname,$Lastname,$Email,$password, $confirm_pass]);
    if($result){
        echo 'Successfully saved.';
        // Optionally, retrieve the auto-generated ID
        $last_id = $mysqli->insert_id;
        echo "The last inserted ID is: " . $last_id;
}else{
    echo 'There were errors while saving the data.';
}
}else{
    echo 'No data';
}
 }catch(mysqli_sql_exception $e){
    echo 'Error: ' . $e->getMessage();
 }

?>
