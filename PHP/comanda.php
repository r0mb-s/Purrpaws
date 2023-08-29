<?php

$servername = "localhost";
$username = "root";
$password = "cita2004";
$dbname = "purrpaws";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$sql = "INSERT INTO comenzi(id_client, id_produs, cantitate) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->execute([$_POST['id_client'], $_POST['id_produs'], $_POST['cantitate']]);
$ok = $stmt->fetchAll();