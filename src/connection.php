<?php

$servername = "localhost";
$username = "root";
$password = "coderslab";
$baseName = "Twitter";

//Tworzenie nowego połączenia z bazą danych
$conn = new mysqli($servername, $username, $password, $baseName);


//Sprawdzenie, czy połączenie się udało
if($conn->connect_error) {
    die("Polaczenie nieudane. Blad:" . $conn->connect_error);
}
else {
    $conn->set_charset("utf8");
    echo("Polaczenie udane<br>");
}


