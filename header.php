<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
       if (isset($_SESSION['userId']))
       {
           echo '<form action="includes/logout.inc.php" method="post">
           <button type="submit" name="logout-submit">Logout</button>
           </form>';
       }
       else
       {
           echo '  <div>
           <form action="includes/login.inc.php" method="post">
           <input type="text" name="mailuid" placeholder="Username/E-mail...">
           <input type="password" name="pwd" placeholder="password">
           <button type="submit" name="login-submit">Login</button>
           </form>
           <a href="signup.php">Signup</a>
           </div>';
       }
    ?>
    <header>
  
    </header>