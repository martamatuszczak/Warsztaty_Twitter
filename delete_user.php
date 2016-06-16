<!DOCTYPE html>
<?php
session_start();   
require_once './src/User.php';
require_once './src/Tweet.php';
require_once './src/Comment.php';
require_once './src/connection.php'; 
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
        <?php
        //Deleting user
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $user = new User();
            $userBeingDeleted = $user->loadFromDB($conn, $_GET['id']);
            $userBeingDeleted->deactivate();
            $userBeingDeleted->saveToDB($conn);
            $_SESSION['loggedUserId'] = null;
            header("Location: login.php");
            echo("User deleted");
        }
        $conn->close();
        $conn = null;
        ?>
    </body>
</html>    