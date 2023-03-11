<?php
session_start();

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

$anonyme = htmlspecialchars($_POST['anonyme']);

if ($anonyme == htmlspecialchars("oui")) {
    $anonyme = true;
    $sqlA = "INSERT INTO Plaignant (anonyme) VALUES ($anonyme)";
    $conn->query($sqlA);
    $sqlB = "SELECT numPlaignant FROM Plaignant ORDER BY numPlaignant DESC LIMIT 1";
    $result = $conn->query($sqlB);
    foreach ($result as $row) {
        $numPlaignant = $row['numPlaignant'];
    }
} else {
    if (!isset($_SESSION['userId'])) {
        $nomPlaignant = htmlspecialchars($_POST['nomPlaignant']);
        $adressePlaignant = htmlspecialchars($_POST['adressePlaignant']);
        $emailPlaignant = htmlspecialchars($_POST['emailPlaignant']);
        $telPlaignant = htmlspecialchars($_POST['telPlaignant']);
        $sqlA = "INSERT INTO Plaignant (nomPlaignant, adressePlaignant, emailPlaignant, telPlaignant, anonyme) VALUES ('$nomPlaignant', '$adressePlaignant','$emailPlaignant','$telPlaignant',0)";
        $conn->query($sqlA);

        $sqlB = "SELECT numPlaignant FROM Plaignant ORDER BY numPlaignant DESC LIMIT 1";
        $result = $conn->query($sqlB);
        foreach ($result as $row) {
            $numPlaignant = $row['numPlaignant'];
        }

        $login = htmlspecialchars($_POST['login']);
        $password = $_POST['password'];
        $accountType = "plaignant";
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $user = "INSERT INTO users (`login`,`password`,`accountType`,`accountId`) VALUES ('$login','$hash','$accountType',$numPlaignant)";
        $conn->query($user);

        $lastRec = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
        $result = $conn->query($lastRec);
        foreach ($result as $row) {
            $userId = $row['id'];
        }

        $_SESSION['userId'] = $userId;
        $_SESSION['numPlaignant'] = $numPlaignant;
        $_SESSION['accountType'] = $accountType;
        $_SESSION['userName'] = $nomPlaignant;
    }else{
        $numPlaignant = $_SESSION['numPlaignant'];
    }
}

if (isset($_FILES['pieceJointe']) && $_FILES['pieceJointe']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['pieceJointe']['tmp_name'];
    $fileName = $_FILES['pieceJointe']['name'];
    $fileSize = $_FILES['pieceJointe']['size'];
    $fileType = $_FILES['pieceJointe']['type'];
    $uploadDir = 'storage/';
    $destPath = $uploadDir . $fileName;
    move_uploaded_file($fileTmpPath, $destPath);
}

$datePlainte = date('Y-m-j');
$objetPlainte = htmlspecialchars($_POST['objetPlainte']);
$descriptionPlainte = htmlspecialchars($_POST['descriptionPlainte']);
$modeEmission = htmlspecialchars($_POST['modeEmission']);
$sqlC = "INSERT INTO Plainte(datePlainte, objetPlainte, descriptionPlainte,pieceJointe, modeEmission, numPlaignant) VALUES ('$datePlainte', '$objetPlainte', '$descriptionPlainte','$destPath', '$modeEmission', $numPlaignant)";
$conn->query($sqlC);

$conn->close();
header("Location: liste_plainte.php");
die();