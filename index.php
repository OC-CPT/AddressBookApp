<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Address Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark">
<div class="container">
<div class="row marg">
<div class="col"></div>
<div class="col text-center">
<form class="form-signin" action="loginProcess.php" method="post">
  <img class="mb-4" src="assests\addressBook.svg" alt="" width="200" height="200">
  <h1 class="h3 mb-3 font-weight-normal text-white">Address Book App</h1>
  <h4 class="h3 mb-3 font-weight-normal text-white">Please sign in</h4>
  <label for="inputEmail" class="sr-only">Username</label>
  <input type="text" id="inputEmail" name="username" class="form-control" placeholder="Username" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
  <?php

// Displays error message if username or password is incorrect

if (isset($_SESSION['wmessage'])): ?>
<? require_once('connection.php'); ?>
<div class="alert alert-<?=$_SESSION['msg_type']?>">

<?php
echo $_SESSION['wmessage'];
unset($_SESSION['wmessage']);
?>
</div>
<?php endif ?>
  <button class="btn btn-lg btn-primary btn-block" value="login" type="submit">Sign in</button>
  <h4 class="h3 mb-3 font-weight-normal text-white">Username: admin <br> Password: admin</h4>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
</form>
</div>
<div class="col"></div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>