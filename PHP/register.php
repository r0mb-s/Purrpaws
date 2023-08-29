<?php

$servername = "localhost";
$username = "root";
$password = "cita2004";
$dbname = "purrpaws";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$sql = "INSERT INTO users (prenume, nume, email, parola) VALUES (?,?,?,?)";
$stmt = $conn->prepare($sql);

$ok = $stmt->execute([$_POST['prenume'], $_POST['nume'], $_POST['email'], $_POST['parola']]);

echo $ok;

if($ok)
    echo "ok";
else
    echo "nok";
