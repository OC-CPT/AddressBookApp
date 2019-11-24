<?php

session_start(); 

include('connectdb.php');

// store values entered in by user
$username = $_POST['username'];
$password = $_POST['password'];

// Select get values in database for username and password
$result = mysqli_query($mysqli, "SELECT * FROM user WHERE username = '$username' and password ='$password'")
    or die("Faild to query database ".mysqli_error());

    // Compare username and password with values in the database 
    $row = mysqli_fetch_array($result);
    if ($row['username'] == $username && $row['password'] == $password ){
       
        // Creates a session message to allow the user to access the main page
        $_SESSION['status'] = "loggedIn";
        header("location: addressBook.php");

        // Creates a session message for incorrect login details, denies access and alerts user
    } else {
        $_SESSION['wmessage'] = "Wrong password has been entered";
        $_SESSION['msg_type'] = "danger";
        header("location: index.php");
    }

?>
