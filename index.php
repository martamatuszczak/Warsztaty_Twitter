<!DOCTYPE html>
<?php
session_start();

if(!isset($_SESSION['loggedUserId'])) {
    header("Location: login.php");    
}
?>




<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        Logged user id = <?php echo $_SESSION['loggedUserId']?> <br>
        <a href='logout.php'>Logout</a>
    </body>
</html>
