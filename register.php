<!DOCTYPE html>
<?php
require_once 'src/User.php';
require_once 'src/connection.php';
session_start();

if (isset($_SESSION['loggedUserId'])) {
    header("Location:index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = strlen(trim($_POST['email'])) > 0 ? trim($_POST['email']) : null;
    $password = strlen(trim($_POST['password'])) > 0 ? trim($_POST['password']) : null;
    $retypedPassword = strlen(trim($_POST['retypedPassword'])) > 0 ? trim($_POST['retypedPassword']) : null;
    $fullName = strlen(trim($_POST['fullName'])) > 0 ? trim($_POST['fullName']) : null;


    $user = User::getUserByEmail($conn, $email);

    if ($email && $password && $retypedPassword && $fullName && $password == $retypedPassword && !$user) {
        $newUser = new User();
        $newUser->setEmail($email);
        $newUser->setPassword($password, $retypedPassword);
        $newUser->setFullName($fullName);
        $newUser->activate();
        if ($newUser->saveToDB($conn)) {
            echo("Registration successful<br>");
            header("Location:index.php");
        } else {
            echo("Error during registration <br>");
        }
    } else {
        if (!$email) {
            echo("Incorrect email<br>");
        }
        if (!$password) {
            echo("Incorrect password<br>");
        }
        if (!$retypedPassword || $password != $retypedPassword) {
            echo("Incorrect retyped password<br>");
        }
        if (!$fullName) {
            echo("Incorrect full name<br>");
        }
        if ($user) {
            echo("User already exists");
        }
    }
    $conn->close();
    $conn = null;
}
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
                <h1>Register</h1>
            </div>
            <div class="row">  
                <div class="col-md-12">
                    <form method="POST">
                        <div class="form-group">
                            <label>
                                Email:
                                <input class="form-control" type="email" name="email">
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                Password:
                                <input class="form-control" type="password" name="password">
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                Retype password:
                                <input class="form-control" type="password" name="retypedPassword">
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                Full name:
                                <input class="form-control" type="text" name="fullName">
                            </label>
                        </div>
                        <input class="btn btn-info" type="submit" value="Register">

                    </form>
                </div>
            </div>    
        </div>
    </body>
</html>
