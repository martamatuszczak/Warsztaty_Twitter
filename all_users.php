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
        <h2>Wybierz użytkownika</h2>
        <?php
        $sql = "SELECT * FROM User";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            echo("<ul>");
            while($row = $result->fetch_assoc()) {
                echo("<li><a href='user_page.php?id={$row['id']}'>Użytkownik: {$row['fullName']} E-mail: {$row['email']}</a></li>");
            }
            echo("</ul>");
        }
        
        echo("<a href='index.php'>Strona główna </a>");
        ?>
    </body>
</html>
