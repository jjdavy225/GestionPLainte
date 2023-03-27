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

$key = file_get_contents('./security/encryption.key');
$iv = file_get_contents('./security/encryptionIv.key');

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
        $nomPlaignant_encrypted = base64_encode(openssl_encrypt($nomPlaignant, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
        $adressePlaignant = htmlspecialchars($_POST['adressePlaignant']);
        $adressePlaignant_encrypted = base64_encode(openssl_encrypt($adressePlaignant, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
        $emailPlaignant = htmlspecialchars($_POST['emailPlaignant']);
        $emailPlaignant_encrypted = base64_encode(openssl_encrypt($emailPlaignant, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
        $telPlaignant = htmlspecialchars($_POST['telPlaignant']);
        $telPlaignant_encrypted = base64_encode(openssl_encrypt($telPlaignant, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
        $sqlA = "INSERT INTO Plaignant (nomPlaignant, adressePlaignant, emailPlaignant, telPlaignant, anonyme) VALUES ('$nomPlaignant_encrypted', '$adressePlaignant_encrypted','$emailPlaignant_encrypted','$telPlaignant_encrypted',0)";
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
        $login_encrypted = base64_encode(openssl_encrypt($login, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
        $accountType_encrypted = base64_encode(openssl_encrypt($accountType, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
        $user = "INSERT INTO users (`login`,`password`,`accountType`,`accountId`) VALUES ('$login_encrypted','$hash','$accountType_encrypted',$numPlaignant)";
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
$destPath_encrypted = base64_encode(openssl_encrypt($destPath, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));

$datePlainte = date('Y-m-j');
$objetPlainte = htmlspecialchars($_POST['objetPlainte']);
$objetPlainte_encrypted = base64_encode(openssl_encrypt($objetPlainte, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
$descriptionPlainte = htmlspecialchars($_POST['descriptionPlainte']);
$descriptionPlainte_encrypted = base64_encode(openssl_encrypt($descriptionPlainte, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
$modeEmission = htmlspecialchars($_POST['modeEmission']);
$modeEmission_encrypted = base64_encode(openssl_encrypt($modeEmission, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
$sqlC = "INSERT INTO Plainte(datePlainte, objetPlainte, descriptionPlainte,pieceJointe, modeEmission, numPlaignant) VALUES ('$datePlainte', '$objetPlainte_encrypted', '$descriptionPlainte_encrypted','$destPath_encrypted', '$modeEmission_encrypted', $numPlaignant)";
$conn->query($sqlC);

$conn->close();
header("Location: liste_plainte.php");
die();