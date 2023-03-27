<?php
session_start();
if (!isset($_SESSION['accountType'])) {
    http_response_code(403);
    header("Location: 403.html");
    die();
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
if (isset($_SESSION['userId']) and $_SESSION['accountType'] == "plaignant") {
    $numPlaignant = $_SESSION['numPlaignant'];
    $sqlB = "SELECT * FROM Plaignant,Plainte WHERE Plaignant.numPlaignant = '$numPlaignant' AND Plaignant.numPlaignant = Plainte.numPlaignant";
    $result = $conn->query($sqlB);
} elseif (isset($_SESSION['userId']) and $_SESSION['accountType'] == "admin") {
    "SELECT * FROM Plaignant,Plainte WHERE Plaignant.numPlaignant = Plainte.numPlaignant";
}
$conn->close();
?>

<?php include 'master.php' ?>

<?php startblock('title') ?>
Liste des plaintes
<?php endblock() ?>


<?php startblock('content') ?>
<div class="pagetitle">
    <h1>Liste des plaintes</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Plaintes</li>
            <li class="breadcrumb-item active">Liste des plaintes</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                Liste des plaintes
            </h5>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Numéro plainte</th>
                        <th>Objet plainte</th>
                        <!-- <th>Description plainte</th> -->
                        <th>Date plainte</th>
                        <!-- <th>Mode d'émission</th> -->
                        <!-- <th>Numéro plaignant</th> -->
                        <th>Nom plaignant</th>
                        <!-- <th>Adresse plaignant</th> -->
                        <!-- <th>Email plaignant</th> -->
                        <!-- <th>Tel plaignant</th> -->
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) : ?>
                        <tr>
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
                            <td><?php echo openssl_decrypt(base64_decode($row['objetPlainte']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv) ?></td>
                            <!-- <td><?php echo openssl_decrypt(base64_decode($row['descriptionPlainte']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv) ?></td> -->
                            <td><?php echo $row['datePlainte'] ?></td>
                            <!-- <td><?php echo openssl_decrypt(base64_decode($row['modeEmission']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv) ?></td> -->
                            <!-- <td><?php echo $row['numPlaignant'] ?></td> -->
                            <td>
                                <?php
                                if ($row['nomPlaignant'] == null) {
                                    echo 'Anonyme';
                                } else {
                                    echo openssl_decrypt(base64_decode($row['nomPlaignant']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
                                }
                                ?>
                            </td>
                            <!-- <td><?php echo openssl_decrypt(base64_decode($row['adressePlaignant']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv) ?></td> -->
                            <!-- <td><?php echo openssl_decrypt(base64_decode($row['emailPlaignant']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv) ?></td> -->
                            <!-- <td><?php echo openssl_decrypt(base64_decode($row['telPlaignant']), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv) ?></td> -->
                            <td>
                                <a style="font-size: 20px; margin: 0px 5px;" href="show_plainte.php?numPlainte=<?php echo $row['numPlainte']; ?>"><i class="bi-eye-fill"></i></a>
                                <a style="font-size: 20px; margin: 0px 5px;" href="download_plainte.php?numPlainte=<?php echo $row['numPlainte']; ?>"><i class="bi bi-file-earmark-arrow-down"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php endblock() ?>