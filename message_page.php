<!DOCTYPE html>
<?php
session_start();
require_once './src/User.php';
require_once './src/Tweet.php';
require_once './src/Message.php';
require_once './src/connection.php';

if (!isset($_SESSION['loggedUserId'])) {
    header("Location: login.php");
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
        <div class="container text-center">  
            <?php
            $loggedUserId = $_SESSION['loggedUserId'];
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                //Nadawca
                if (isset($_GET['author_id'])) {
                    $author = new User();
                    $author->loadFromDB($conn, $_GET['author_id']);
                    echo("<h3>Author: {$author->getFullName()}</h3>");
                }
                //Odbiorca
                if (isset($_GET['receiver_id'])) {
                    $receiver = new User();
                    $receiver->loadFromDB($conn, $_GET['receiver_id']);
                    echo("<h3>Receiver: {$receiver->getFullName()}</h3>");
                }
                //Treść
                if (isset($_GET['message_id'])) {
                    $messageInfo = new Message();
                    $messageInfo->loadFromDB($conn, $_GET['message_id']);
                    echo("<h4 class='left'>Title: {$messageInfo->getTitle()}</h4><div class='well'><p class='left'>{$messageInfo->getText()}</p></div>");
                }
                //Zmiana statusu na przeczytany
                if ($_GET['author_id'] !== $loggedUserId) {
                    $sql = "UPDATE Message SET status=1 WHERE id={$_GET['message_id']} ";
                    if ($conn->query($sql) === TRUE) {
                        return TRUE;
                    } else {
                        echo("Connection error");
                    }
                }
                $conn->close();
                $conn = null;
            }
            ?>
    </body>
</html>
