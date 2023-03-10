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

$sqlB = "SELECT * FROM Service";
$result = $conn->query($sqlB);
$conn->close();
?>

<?php include 'master.php' ?>

<?php startblock('title') ?>
Liste des services
<?php endblock() ?>


<?php startblock('content') ?>
<div class="pagetitle">
    <h1>Liste des services</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Services</li>
            <li class="breadcrumb-item active">Liste des services</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                Liste des services
            </h5>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Code du service</th>
                        <th>Libellé du service</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) : ?>
                        <tr>
                            <td>
                                <?php
                                    switch(strlen($row['codeService'])){
                                        case 1:
                                            echo 'SER00'.$row['codeService'];
                                            break;
                                        case 2:
                                            echo 'SER0'.$row['codeService'];
                                            break;
                                        case 3:
                                            echo 'SER'.$row['codeService'];
                                            break;
                                    }
                                ?>
                            </td>
                            <td><?php echo $row['libelleService'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php endblock() ?>