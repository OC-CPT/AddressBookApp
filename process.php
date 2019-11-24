<?php

// Only starts a session if one does not exist
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('connectdb.php');

// Set update button to false
$update = false;
$contact_id = 0;

// Set variables to empty strings
$fname = "";
$lname = "";
$cnumber = "";
$email = "";


// Check if save button has been pressed, then proceed with logic

if (isset($_POST['save'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $cnumber = $_POST['cnumber'];
    $email = $_POST['email'];

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: addressBook.php");

    // Query to insert data in db

    $mysqli->query("INSERT INTO contact (fname,lname,cnumber,email) VALUES('$fname','$lname','$cnumber','$email')")
    or die($mysqli->error);
}

// Check if save button has been pressed, then proceed with logic

if (isset($_GET['delete'])){
    $contact_id = $_GET['delete'];
    $mysqli->query("DELETE FROM contact WHERE contact_id=$contact_id") or die($mysqli->error());

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: addressBook.php");

}

// Check if edit button has been pressed, then proceed with logic

if (isset($_GET['edit'])){
    $contact_id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM contact WHERE contact_id=$contact_id") or die($mysqli->error());
    if (count($result)==1){
        $row = $result->fetch_array();
        $fname = $row['fname'];
        $lname = $row['lname'];
        $cnumber = $row['cnumber'];
        $email = $row['email'];
    }
}

// After edit button is pressed, it checks if update button has been pressed, then proceed with logic

if (isset($_POST['update'])){
    $contact_id = $_POST['contact_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $cnumber = $_POST['cnumber'];
    $email = $_POST['email'];

    $mysqli->query("UPDATE contact SET fname='$fname', lname='$lname', cnumber='$cnumber', email='$email' WHERE contact_id =$contact_id") or
        die($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: addressBook.php");
}

?>