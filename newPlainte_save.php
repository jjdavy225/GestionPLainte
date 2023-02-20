<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GestionPlainte";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$anonyme = $_POST['anonyme'];

if ($anonyme == "oui") {
    $anonyme = true;
    $sqlA = "INSERT INTO Plaignant (anonyme) VALUES ($anonyme)";
}else {
    $nomPlaignant = $_POST['nomPlaignant'];
    $adressePlaignant = $_POST['adressePlaignant'];
    $emailPlaignant = $_POST['emailPlaignant'];
    $telPlaignant = $_POST['telPlaignant'];
    $sqlA = "INSERT INTO Plaignant (nomPlaignant, adressePlaignant, emailPlaignant, telPlaignant, anonyme) VALUES ('$nomPlaignant', '$adressePlaignant','$emailPlaignant','$telPlaignant',0)";
}
$conn->query($sqlA);


$sqlB = "SELECT numPlaignant FROM Plaignant ORDER BY numPlaignant DESC LIMIT 1";
$result = $conn->query($sqlB);
foreach ($result as $row) {
    $numPlaignant = $row['numPlaignant'];
}


$datePlainte = date('Y-m-j');
$objetPlainte = htmlspecialchars($_POST['objetPlainte']);
$descriptionPlainte = htmlspecialchars($_POST['descriptionPlainte']);
$modeEmission = htmlspecialchars($_POST['modeEmission']);
$sqlC = "INSERT INTO Plainte(datePlainte, objetPlainte, descriptionPlainte, modeEmission, numPlaignant) VALUES ('$datePlainte', '$objetPlainte', '$descriptionPlainte', '$modeEmission', $numPlaignant)";
$conn->query($sqlC);

$conn->close();

header("Location: liste_plainte.php");
die()
?>