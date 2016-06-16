<!DOCTYPE html>
<?php
session_start();
require_once 'src/connection.php';
require_once 'src/User.php';

//Login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strlen(trim($_POST['email'])) > 0 ? trim($_POST['email']) : null;
    $password = strlen(trim($_POST['password'])) > 0 ? trim($_POST['password']) : null;

    if ($email && $password) {
        if ($loggedUserId = User::login($conn, $email, $password)) {
            $_SESSION['loggedUserId'] = $loggedUserId;
            header("Location: index.php");
        } else {
            echo("Incorrect email or password<br>");
        }
    }
}
$conn->close();
$conn = null;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/bootstrap.css">
        <title></title>
    </head>
    <body>
        <div class="container text-center">   
            <div class="jumbotron">
                <h1>Log in to continue</h1>
            </div>
            <div class="row">  
                <div class="col-md-12">
                    <form method="POST" role="form">
                        <div class="form-group">
                            <label>
                                Email:
                                <input class="form-control" type="text" name="email">
                            </label> 
                        </div>
                        <div class="form-group">
                            <label>
                                Password:
                                <input class="form-control" type="password" name="password">
                            </label>
                        </div>
                        <input class="btn btn-info" type="submit" value="Login">
                        <br>
                        <a class="tweet_link" href="register.php">Registration</a>
                    </form>
                </div>      
            </div>          
        </div>    
    </body>
</html>
