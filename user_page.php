<!DOCTYPE html>
<?php
session_start();   
require_once './src/User.php';
require_once './src/Tweet.php';
require_once './src/connection.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $loggedUserId = $_SESSION['loggedUserId'];
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $userId = $_GET['id'];            
            $userInfo = User::getUserById($conn, $userId);
            echo("<h1>{$userInfo['fullName']}</h1>");
            echo("<h3>E-mail: {$userInfo['email']}</h3>");
            
            if($userId === $loggedUserId) {
                echo("<a href='edit_user.php?id=$loggedUserId'>Edytuj informacje</a>");  
            }
            else {
                echo("<a href='create_message.php?id=$userId'>Wiadomość</a>"); 
            }
            
            
            echo("<h2>Tweety użytkownika</h2>");
            $userTweets = User::loadAllTweets($conn, $userId); 
            echo("<ul>");
            for($i = 0; $i < count($userTweets); $i++) {         
                    echo("<li>" . $userTweets[$i][1] . "</li>");  
            }
            echo("</ul>");
        }

        echo("<a href='index.php'>Strona główna </a>");
        echo("<a href='all_users.php'>Wszyscy użytkownicy </a>");
        ?>
    </body>
</html>
