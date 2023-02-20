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

$sqlB = "SELECT * FROM Plaignant,Plainte WHERE Plaignant.numPlaignant = Plainte.numPlaignant";
$result = $conn->query($sqlB);
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
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>Numéro plainte</th>
                        <th>Date plainte</th>
                        <th>Objet plainte</th>
                        <th>Description plainte</th>
                        <th>Date reception</th>
                        <th>Mode d'émission</th>
                        <th>Numéro plaignant</th>
                        <th>Nom plaignant</th>
                        <th>Adresse plaignant</th>
                        <th>Email plaignant</th>
                        <th>Tel plaignant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) : ?>
                        <tr>
                            <td><?php echo $row['numPlainte'] ?></td>
                            <td><?php echo $row['datePlainte'] ?></td>
                            <td><?php echo $row['objetPlainte'] ?></td>
                            <td><?php echo $row['descriptionPlainte'] ?></td>
                            <td><?php echo $row['dateReception'] ?></td>
                            <td><?php echo $row['modeEmission'] ?></td>
                            <td><?php echo $row['numPlaignant'] ?></td>
                            <td><?php echo $row['nomPlaignant'] ?></td>
                            <td><?php echo $row['adressePlaignant'] ?></td>
                            <td><?php echo $row['emailPlaignant'] ?></td>
                            <td><?php echo $row['telPlaignant'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php endblock() ?>