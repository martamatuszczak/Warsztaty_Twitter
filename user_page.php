<!DOCTYPE html>
<?php
session_start();
require_once './src/User.php';
require_once './src/Tweet.php';
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
            <div class="row">  
                <div class="col-md-10 left">
                    <?php
                    $loggedUserId = $_SESSION['loggedUserId'];
                    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                        //Wyświetlanie informacji o użytkowniku
                        $userId = $_GET['id'];
                        $userInfo = User::getUserById($conn, $userId);
                        echo("<h1>{$userInfo['fullName']}</h1>");
                        echo("<h3>{$userInfo['email']}</h3>
                                    </div>
                                    <div class='col-md-2'><br><br>");

                        if ($userId === $loggedUserId) {
                            //Linki do edycji użytkownika i do jego usunięcia
                            echo("<a class='btn btn-info' href='edit_user.php?id=$loggedUserId'>Edit info</a><br><br>");
                            echo("<a class='btn btn-info' href='delete_user.php?id=$loggedUserId'>Delete account</a>");
                        } else {
                            //Link do wysłania wiadomości
                            echo("<a class='btn btn-info' href='create_message.php?id=$userId'>Message</a>");
                        }
                        echo("</div></div>");


                        //Wszystkie tweety użytkownika
                        echo("<div class='row'>  
                                    <div class='col-md-12'>
                                        <h3>All tweets</h3>");
                        $userTweets = User::loadAllTweets($conn, $userId);
                        echo("<div class='list-group'>");
                        for ($i = 0; $i < count($userTweets); $i++) {
                            $tweetComments = Tweet::loadAllComments($conn, $userTweets[$i][0]);
                            $commentsCount = count($tweetComments);
                            echo("<a class='list-group-item' href='tweet_page.php?id={$userTweets[$i][0]}'>{$userTweets[$i][1]}<span class='badge'>$commentsCount</span></a>");
                        }
                        echo("</div>");
                    }
                    $conn->close();
                    $conn = null;
                    ?>

                </div>
            </div>   
        </div>                
    </body>
</html>
