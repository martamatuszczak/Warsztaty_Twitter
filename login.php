<!DOCTYPE html>
<?php
session_start();
require_once 'src/connection.php';
require_once 'src/User.php';


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strlen(trim($_POST['email'])) > 0 ?trim($_POST['email']) :null;
    $password = strlen(trim($_POST['password'])) > 0 ?trim($_POST['password']) :null;
    
    if($email && $password) {
        if($loggedUserId = User::login($conn, $email, $password)) {
            $_SESSION['loggedUserId'] = $loggedUserId;
            header("Location: index.php");
        }
        else {
            echo("Incorrect email or password<br>");
        }
    }
} 

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST">
            <fieldset>
                <label>
                    Email:
                    <input type="text" name="email">
                </label> 
                <br>
                <label>
                    Password:
                    <input type="password" name="password">
                </label>
                <br>
                <input type="submit" value="Login">
            </fieldset> 
            <a href="register.php">Registration</a>
        </form>
    </body>
</html>
