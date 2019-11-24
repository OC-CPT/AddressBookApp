<?php

/* Logout to destroy user session which revokes access 
by destroying the session and then redirects user to login page */

session_start();
session_destroy();
unset($_SESSION['status']);
header("location: index.php");