<?php
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GestionPlainte";
$dompdf = new Dompdf();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$key = file_get_contents('./security/encryption.key');
$iv = file_get_contents('./security/encryptionIv.key');

$numPlainte = $_GET['numPlainte'];
$sqlB = "SELECT * FROM Plaignant,Plainte WHERE Plaignant.numPlaignant = Plainte.numPlaignant AND Plainte.numPlainte = $numPlainte";
$result = $conn->query($sqlB);
$conn->close();

foreach ($result as $row) {
    $datePlainte = $row['datePlainte'];
    $objetPlainte = openssl_decrypt(base64_decode($row['objetPlainte']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    $descriptionPlainte = openssl_decrypt(base64_decode($row['descriptionPlainte']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    $modeEmission = openssl_decrypt(base64_decode($row['modeEmission']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    if ($row['pieceJointe'] != null) {
        $pieceJointe = openssl_decrypt(base64_decode($row['pieceJointe']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
        $msgPJ = "Oui";
    } else {
        $msgPJ = "Aucune";
    }
    $numPlaignant = $row['numPlaignant'];
    $nomPlaignant = openssl_decrypt(base64_decode($row['nomPlaignant']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    $adressePlaignant = openssl_decrypt(base64_decode($row['adressePlaignant']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    $emailPlaignant = openssl_decrypt(base64_decode($row['emailPlaignant']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    $telPlaignant = openssl_decrypt(base64_decode($row['telPlaignant']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
}

switch (strlen($numPlainte)) {
    case 1:
        $numPlainte_ = 'PL00' . $numPlainte;
        break;
    case 2:
        $numPlainte_ = 'PL0' . $numPlainte;
        break;
    case 3:
        $numPlainte_ = 'PL' . $numPlainte;
        break;
}

switch (strlen($numPlaignant)) {
    case 1:
        $numPlaignant = 'PL00' . $numPlaignant;
        break;
    case 2:
        $numPlaignant = 'PL0' . $numPlaignant;
        break;
    case 3:
        $numPlaignant = 'PL' . $numPlaignant;
        break;
}

$html = file_get_contents('downloadPage.php');
$html = str_replace('{{numPlainte}}', $numPlainte_, $html);
$html = str_replace('{{datePlainte}}', $datePlainte, $html);
$html = str_replace('{{objetPlainte}}', $objetPlainte, $html);
$html = str_replace('{{descriptionPlainte}}', $descriptionPlainte, $html);
$html = str_replace('{{modeEmission}}', $modeEmission, $html);
$html = str_replace('{{pieceJointe}}', $msgPJ, $html);
$html = str_replace('{{numPlaignant}}', $numPlaignant, $html);
$html = str_replace('{{nomPlaignant}}', $nomPlaignant, $html);
$html = str_replace('{{adressePlaignant}}', $adressePlaignant, $html);
$html = str_replace('{{emailPlaignant}}', $emailPlaignant, $html);
$html = str_replace('{{telPlaignant}}', $telPlaignant, $html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->loadHtml($html);
$dompdf->render();
$filename = 'plainte'.$numPlainte_.'.pdf';
$dompdf->stream($filename, ['Attachment' => true]);

exit();
