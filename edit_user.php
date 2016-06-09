<!DOCTYPE html>
<?php
session_start();
require_once './src/User.php';
require_once './src/Tweet.php';
require_once './src/connection.php';

if (!isset($_SESSION['loggedUserId'])) {
    header("Location: login.php");
}

$loggedUserId = $_SESSION['loggedUserId'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/bootstrap.css">
        <title></title>
    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Logo</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href='all_users.php'>All users</a></li>
                        <li><a href='messages_page.php'>Messages</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href='logout.php'>Logout</a> </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h2>Change e-mail</h2>
                    <form method="POST" role="form" class="form-inline">
                        <div class="form-group">
                            <label>
                                New e-mail:
                                <input class="form-control" type="email" name="new_email" >
                            </label>
                        </div>
                        <button class="btn btn-info" type="submit" name="submit" value="new_email_submit">Edit</button> 
                    </form> 
                    <h2>Change full name</h2>
                    <form method="POST" role="form" class="form-inline">
                        <div class="form-group">
                            <label>
                                New full name:
                                <input class="form-control" type="text" name="new_full_name">
                            </label>
                        </div>
                        <button class="btn btn-info" type="submit" name="submit" value="new_name_submit">Edit</button>                
                    </form>
                    <h2>Change password</h2>
                    <form method="POST" role="form" class="form-inline">
                        <div class="form-group">
                            <label>
                                New password:
                                <input class="form-control" type="password" name="new_password">
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                Repeat password:
                                <input class="form-control" type="password" name="new_password_repeated">  
                            </label>
                        </div>
                        <button class="btn btn-info" type="submit" name="submit" value="new_password_submit">Edit</button>
                    </form>
                    <?php
                    $oldUser = new User();
                    $oldUser->loadFromDB($conn, $loggedUserId);
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                        switch ($_POST['submit']) {
                            case 'new_email_submit':
                                if (!empty($_POST['new_email'])) {
                                    $oldUser->setEmail($_POST['new_email']);
                                    $oldUser->saveToDB($conn);
                                    echo("Changed e-mail");
                                }
                                break;

                            case 'new_name_submit':
                                if (!empty($_POST['new_full_name'])) {
                                    $oldUser->setFullName($_POST['new_full_name']);
                                    $oldUser->saveToDB($conn);
                                    echo("Changed full name");
                                }
                                break;

                            case 'new_password_submit':
                                if (!empty($_POST['new_password']) && !empty($_POST['new_password_repeated'])) {
                                    $oldUser->setPassword($_POST['new_password'], $_POST['new_password_repeated']);
                                    $oldUser->saveToDB($conn);
                                    echo("Changed password");
                                }
                                break;
                        }
                    }
                    echo(
                    '</div>
                <div class="col-md-2">
                <br><br>'
                    );
                    echo("<a class='btn btn-info' href='user_page.php?id=$loggedUserId'>Return to user page</a>
                </div>");
                    $conn->close();
                    $conn = null;
                    ?> 
                </div>     
            </div>
        </div>
    </body>
</html>
