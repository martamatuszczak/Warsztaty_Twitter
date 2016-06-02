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
        
        <form method="post">
            <textarea name="tweet" maxlength="140"></textarea>
            <br>
            <input type="submit" value="Wyślij">
        </form>
        
        <?php
        require_once './src/User.php';
        require_once './src/Tweet.php';
        require_once './src/connection.php';
        
        if($_SERVER['REQUEST_METHOD'] === "POST") {
            if(!empty($_POST['tweet'])) {
                $text = $_POST['tweet'];
                $userId = $_SESSION['loggedUserId'];
                $newTweet = new Tweet();
                $newTweet->setUserID($userId);
                $newTweet->setText($text);
                $newTweet->saveTweetToDB($conn);  
            }
            else {
                echo("Nie możesz dodać pustego tweeta");
            }
        }
        

        $allTweets = User::loadAllTweets($conn, $_SESSION['loggedUserId']);
        
        echo("<ul>");
        for($i = 0; $i < count($allTweets); $i++) {         
                echo("<li>{$allTweets[$i][1]}<br><a href='tweet_page.php?id={$allTweets[$i][0]}'>Wyświetl tweet</a></li>");  
        }
        echo("</ul>");
        
      
        echo("<a href='all_users.php'>Wszyscy użytkownicy </a>");
        echo("<a href='messages_page.php'>Wiadomości użytkownika</a>");

        ?>
    </body>
</html>
