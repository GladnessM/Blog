<?php
    session_start();
    // Destroy the session
    session_destroy();

// Redirect the user to the welcome page
header("Location: welcome.php");
exit;
?>