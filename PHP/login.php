<?php

$servername = "localhost";
$username = "root";
$password = "cita2004";
$dbname = "purrpaws";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$sql = "SELECT email, parola, id FROM users WHERE email=?";

$stmt = $conn->prepare($sql);
$stmt->execute([$_POST['email']]);
$ok = $stmt->fetch();

if(!$ok || $ok[0] != $_POST['email'])
    echo "wemail";
else{
    if($ok[1] != $_POST['parola'])
        echo "wparola";
    else
        echo $ok[2];
}