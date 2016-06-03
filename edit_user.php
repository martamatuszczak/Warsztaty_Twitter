<!DOCTYPE html>
<?php
session_start();   
require_once './src/User.php';
require_once './src/Tweet.php';
require_once './src/connection.php';

if(!isset($_SESSION['loggedUserId'])) {
    header("Location: login.php");    
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./css/style.css">
        <title></title>
    </head>
    <body>
        <form method="POST">
            New e-mail:
            <input type="email" name="new_email">
            <button type="submit" name="submit" value="new_email_submit">Edit</button> 
        </form>   
        <form method="POST">
            New full name:
            <input type="text" name="new_full_name">
            <button type="submit" name="submit" value="new_name_submit">Edit</button>                
        </form>
        
        <form method="POST">
            New password:
            <input type="password" name="new_password">
            Repeat password:
            <input type="password" name="new_password_repeated">  
            <button type="submit" name="submit" value="new_password_submit">Edit</button>
        </form>
        <?php
            $oldUser = new User();
            $oldUser->loadFromDB($conn, $_SESSION['loggedUserId']);
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                switch ($_POST['submit']) {
                    case 'new_email_submit':
                        if(!empty($_POST['new_email'])) {
                            $oldUser->setEmail($_POST['new_email']);
                            $oldUser->saveToDB($conn);
                            echo("Changed e-mail");
                        }
                        break;
                    
                     case 'new_name_submit':
                         if(!empty($_POST['new_full_name'])) {
                            $oldUser->setFullName($_POST['new_full_name']);
                            $oldUser->saveToDB($conn);
                            echo("Changed full name");
                         }
                        break;
                        
                    case 'new_password_submit':
                        if(!empty($_POST['new_password']) && !empty($_POST['new_password_repeated'])) {
                            $oldUser->setPassword($_POST['new_password'], $_POST['new_password_repeated']);
                            $oldUser->saveToDB($conn);
                            echo("Changed password");
                        }
                        break;      
                }
            }
        ?>
    </body>
</html>
