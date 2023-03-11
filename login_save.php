<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GestionPlainte";

session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$login = htmlspecialchars($_POST['login']);
$password = htmlspecialchars($_POST['password']);

$users = $conn->prepare("SELECT `id`,`password`,`nomPlaignant`,`numPlaignant`,`accountType` FROM users,Plaignant WHERE users.login = ? AND users.accountId = Plaignant.numPlaignant");
$users->bind_param('s', $login);
$users->execute();
$users->bind_result($userId, $passwordHash, $nomPlaignant, $numPlaignant, $accountType);
$users->fetch();
if ($passwordHash && password_verify($password, $passwordHash)) {
    $_SESSION['userId'] = $userId;
    $_SESSION['numPlaignant'] = $numPlaignant;
    $_SESSION['accountType'] = $accountType;
    $_SESSION['userName'] = $nomPlaignant;

    header("Location: index.php");
    die();
}else{
    $_SESSION['credentials_error'] = "wrong";
    header("Location: login.php");
    die();
}

print_r($_SESSION);


$conn->close();
