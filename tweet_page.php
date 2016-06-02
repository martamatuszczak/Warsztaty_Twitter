<!DOCTYPE html>
<?php
session_start();   
require_once './src/User.php';
require_once './src/Tweet.php';
require_once './src/Comment.php';
require_once './src/connection.php';       
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if(isset($_GET)){
            $tweetId = $_GET['id'];
            
            $thisTweet = Tweet::show($conn, $tweetId);
            
            $userInfo = User::getUserById($conn, $thisTweet['user_id']);
            echo("<h1>Autor: {$userInfo['fullName']}</h1>");
            echo("<h3>Tweet:</h3>");
            echo("<div>{$thisTweet['text']}</div>");
            
            $tweetComments = Comment::loadAllComments($conn, $tweetId);
            echo("<h4>Komentarze:</h4>");
            echo("<dl>");
            for($i = 0; $i < count($tweetComments); $i++) {         
                    echo("<dt><a href='user_page.php?id={$thisTweet['user_id']}'> {$tweetComments[$i][0]}</a> <br> {$tweetComments[$i][2]}</dt>"); 
                    echo("<dd>{$tweetComments[$i][1]}</dd>");
            }
            echo("</dl>");
        }        
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!empty($_POST['comment'])) {
                $newComment = new Comment();
                $newComment->setTweetId($_GET['id']);
                $newComment->setUserId($_SESSION['loggedUserId']);
                $newComment->setCreationDate(date('Y-m-d G:i'));
                $newComment->setText($_POST['comment']);
                $newComment->saveCommentToDB($conn);
                echo("dodany komentarz");
            }
        }
        
        
        ?>
        <form method="POST">
            <textarea maxlength="100" name="comment"></textarea>
            <br>
            <input type="submit" value="Skomentuj">
        </form>
        
        <?php
        echo("<a href='index.php'>Strona główna </a>");
        echo("<a href='user_page.php?id={$thisTweet['user_id']}'>Strona użytkownika</a>"); 
        ?>
    </body>
</html>

