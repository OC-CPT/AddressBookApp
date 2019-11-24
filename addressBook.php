<?php

// Session to check is user is logged in, otherwise redirect back to login page
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if(!isset($_SESSION['status']))
{
    // not logged in
    header('Location: login.php');
}

include('connectdb.php');
include('process.php');


// set variable value to a empty string
$output= '';

?>

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
<body class="bg-light">
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
<img class="mb-4" id="logo" src="assests\addressBook.svg" alt="" width="50" height="50">
  <a class="navbar-brand" id="logotxt" href="addressBook.php">Address Book</a>

<div class="navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
  </ul>
    <a href="logout.php" id="logoutbtn" class="btn d-flex justify-content-end btn-danger my-2 my-sm-0" role="button" aria-pressed="true">Logout</a>
</div>
</nav>

<!------ Functionailty for create/update/delete message -------------->

<?php
if (isset($_SESSION['message'])): ?>
<div class="alert text-center alert-<?=$_SESSION['msg_type']?>">
<?php 
    echo $_SESSION['message'];
    unset($_SESSION['message']);
?>
</div>
<?php endif ?>

<!------ Contact Form for saving and editing records -------------->

<div class="container">
        <div class="row marg">
          <div class="row formpadding">
        <div class="col-sm bg-dark">
          <h2 id="add">Add a new contact:</h2>
            <form action="process.php" method="post">
                <input type="hidden" name="contact_id" value="<?php echo $contact_id; ?>">
                <div class="form-group">
                <label>First name</label><br>
                <input type="text" name="fname" value="<?php echo $fname; ?>"></div>
                <div class="form-group">
                <label>Last name</label><br>
                <input type="text" name="lname" value="<?php echo $lname; ?>"></div>
                <div class="form-group">
                <label>Contact Number</label><br>
                <input type="number" name="cnumber" value="<?php echo $cnumber; ?>"></div>
                <div class="form-group">
                <label>Email Address</label><br>
                <input type="text" name="email" value="<?php echo $email; ?>"></div>
                <div class="form-group">
                <?php
                if ($update == true):
                ?>
                    <button type="submit" class=" btn btn-warning" name="update">Update</button>
                <?php else: ?>
                <button type="submit" class=" btn btn-primary" name="save">Save</button>
                <?php endif; ?>
                </div>
                </div>
            </form>
            </div>
            <div class="row">         
<div class="col-sm margright">
<h2 id="search">Search a contact:</h2>
<form action="addressBook.php" method="get" class="form-inline my-2 my-lg-0 d-flex justify-content-center">
      <input class="form-control mr-sm-2" type="text" name="search" placeholder="First or Last Name" aria-label="Search">
      <button class="btn btn-info my-2 my-sm-0" type="submit">Search</button>
    </form>

<?php

// Print out search results

include('search.php');
 print ("$output"); 

?>

<!------ Fetchig data and printing records in a table -------------->

<?php    $result = $mysqli->query("SELECT * FROM contact") or die($mysqli->error);
        ?>
        <table class="table table-hover table-dark formmarg">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
        <?php
            while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['fname']; ?></td>
                <td><?php echo $row['lname']; ?></td>
                <td><?php echo $row['cnumber']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="addressBook.php?edit=<?php echo $row['contact_id']; ?>"
                    class="btn btn-info">Edit</a>
                    <a href="process.php?delete=<?php echo $row['contact_id']; ?>"
                    class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>  
</div>
</div> 
        </div>
    </div>
</div>
<div class="container-fluid bg-dark margb">
<footer class="pt-4 my-md-5 pt-md-5 border-top bg-dark">
        <div class="row">
          <div class="col-sm-12 d-flex justify-content-center">
          <h2 class="navbar-brand text-white logo2" href="addressBook.php">Address Book App</h2>
          <img class="mb-4" src="assests\addressBook.svg" alt="" width="50" height="50">
          </div>
        </div>
      </footer>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>