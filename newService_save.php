<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GestionPlainte";

// Need validation rules here

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$libelleService = $_POST['libelleService'];

$sql = "INSERT INTO Service (libelleService) VALUES ('$libelleService')";
$conn->query($sql);

$conn->close();

header("Location: liste_service.php");
die()
?>