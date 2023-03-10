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

$sqlB = "SELECT codeTransmission,dateTransmission,objetPlainte,libelleService,dateReception FROM Transmission,Plainte,Service WHERE Transmission.numPlainte = Plainte.numPlainte AND Transmission.codeService = Service.codeService";
$result = $conn->query($sqlB);
$conn->close();
?>

<?php include 'master.php' ?>

<?php startblock('title') ?>
Liste des services
<?php endblock() ?>


<?php startblock('content') ?>
<div class="pagetitle">
    <h1>Liste des transmissions</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Transmissions</li>
            <li class="breadcrumb-item active">Liste des transmissions</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                Liste des transmissions
            </h5>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Code de la transmission</th>
                        <th>Date de transmission</th>
                        <th>Objet de la plainte</th>
                        <th>Libellé du service</th>
                        <th>Date de reception</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) : ?>
                        <tr>
                            <td>
                                <?php
                                switch (strlen($row['codeTransmission'])) {
                                    case 1:
                                        echo 'TR00' . $row['codeTransmission'];
                                        break;
                                    case 2:
                                        echo 'TR0' . $row['codeTransmission'];
                                        break;
                                    case 3:
                                        echo 'TR' . $row['codeTransmission'];
                                        break;
                                }
                                ?>
                            </td>
                            <td><?php echo $row['dateTransmission'] ?></td>
                            <td><?php echo $row['objetPlainte'] ?></td>
                            <td><?php echo $row['libelleService'] ?></td>
                            <td>
                                <?php
                                if ($row['dateReception'] != null) {
                                    echo $row['dateReception'];
                                } else {
                                    echo 'Pas encore reçu';
                                }
                                ?>
                            </td>
                            <!-- <td><a href="show_plainte.php?numPlainte=<?php echo $row['numPlainte']; ?>"><i class="bi-eye-fill"></i></a></td> -->
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php endblock() ?>