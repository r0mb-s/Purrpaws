<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "cita2004";
$dbname = "purrpaws";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$sql = "INSERT INTO mesaje(prenume, nume, email, subiect, mesaj) VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->execute([$_POST['prenume'], $_POST['nume'], $_POST['email'], $_POST['subiect'], $_POST['mesaj']]);
$ok = $stmt->fetchAll();