<?php
session_start();
if (!isset($_SESSION['accountType'])) {
    http_response_code(403);
    die('Forbidden');
}

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

$key = file_get_contents('./security/encryption.key');
$iv = file_get_contents('./security/encryptionIv.key');

$numPlainte = $_GET['numPlainte'];
$sqlB = "SELECT * FROM Plaignant,Plainte WHERE Plaignant.numPlaignant = Plainte.numPlaignant AND Plainte.numPlainte = $numPlainte";
$result = $conn->query($sqlB);
$conn->close();
?>

<?php include 'master.php' ?>

<?php startblock('title') ?>
Infos plainte
<?php endblock() ?>


<?php startblock('content') ?>
<div class="pagetitle">
    <h1>Infos plainte</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Plaintes</li>
            <li class="breadcrumb-item"><a href="liste_plainte.php">Liste des plaintes</a></li>
            <li class="breadcrumb-item active">Infos plainte</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="card">
        <div class="row card-body">
            <?php foreach ($result as $row) : ?>
                <div class="col-lg-6">
                    <h5 class="card-title text-center">
                        Informations sur la plainte
                    </h5>
                    <table class="table table-bordered col-lg-6">
                        <tr>
                            <th>Numéro de la plainte</th>
                            <td>
                                <?php
                                switch (strlen($row['numPlainte'])) {
                                    case 1:
                                        echo 'PL00' . $row['numPlainte'];
                                        break;
                                    case 2:
                                        echo 'PL0' . $row['numPlainte'];
                                        break;
                                    case 3:
                                        echo 'PL' . $row['numPlainte'];
                                        break;
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Date de la plainte</th>
                            <td><?php echo $row['datePlainte'] ?></td>
                        </tr>
                        <tr>
                            <th>Objet</th>
                            <td><?php echo openssl_decrypt(base64_decode($row['objetPlainte']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv) ?></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><?php echo openssl_decrypt(base64_decode($row['descriptionPlainte']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv) ?></td>
                        </tr>
                        <tr>
                            <th>Mode d'émission</th>
                            <td><?php echo openssl_decrypt(base64_decode($row['modeEmission']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv) ?></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><?php echo openssl_decrypt(base64_decode($row['descriptionPlainte']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv) ?></td>
                        </tr>
                        <tr>
                            <th>Pièces jointes</th>
                            <td>
                                <?php
                                if ($row['pieceJointe'] != null) {
                                    echo "<a target='_blank' href=" . openssl_decrypt(base64_decode($row['pieceJointe']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv) . ">Consulter ici !</a>";
                                } else {
                                    echo "Aucune";
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <h5 class="card-title text-center">
                        Informations sur le plaignant
                    </h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Numéro du plaignant</th>
                            <td>
                                <?php
                                switch (strlen($row['numPlaignant'])) {
                                    case 1:
                                        echo 'PL00' . $row['numPlaignant'];
                                        break;
                                    case 2:
                                        echo 'PL0' . $row['numPlaignant'];
                                        break;
                                    case 3:
                                        echo 'PL' . $row['numPlaignant'];
                                        break;
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Nom</th>
                            <td><?php if (!$row['anonyme']) {
                                    echo openssl_decrypt(base64_decode($row['nomPlaignant']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
                                } else {
                                    echo 'Anonyme';
                                }  ?></td>
                        </tr>
                        <tr>
                            <th>Adresse</th>
                            <td><?php if (!$row['anonyme']) {
                                    echo openssl_decrypt(base64_decode($row['adressePlaignant']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
                                } else {
                                    echo 'Anonyme';
                                } ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php if (!$row['anonyme']) {
                                    echo openssl_decrypt(base64_decode($row['emailPlaignant']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
                                } else {
                                    echo 'Anonyme';
                                } ?></td>
                        </tr>
                        <tr>
                            <th>Téléphone</th>
                            <td><?php if (!$row['anonyme']) {
                                    echo openssl_decrypt(base64_decode($row['telPlaignant']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
                                } else {
                                    echo 'Anonyme';
                                } ?></td>
                        </tr>
                    </table>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
<?php endblock() ?>