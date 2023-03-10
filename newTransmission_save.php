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

$numPlainte = $_POST['numPlainte'];
$codeService = $_POST['codeService'];
$dateTransmission = date('Y-m-j');

$sql = "INSERT INTO Transmission (dateTransmission,numPlainte,codeService) VALUES ('$dateTransmission',$numPlainte,$codeService)";
$conn->query($sql);

$conn->close();

header("Location: liste_transmission.php");
die()
?>