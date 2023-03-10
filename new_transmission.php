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

$sqlA = "SELECT numPlainte,objetPlainte FROM Plainte";
$plaintes = $conn->query($sqlA);
$sqlB = "SELECT * FROM Service";
$services = $conn->query($sqlB);
$conn->close();
?>

<?php include 'master.php' ?>

<?php startblock('title') ?>
Nouvelle transmission
<?php endblock() ?>

<?php startblock('content') ?>
<div class="pagetitle">
	<h1>Nouvelle transmission</h1>
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php">Home</a></li>
			<li class="breadcrumb-item">Transmissions</li>
			<li class="breadcrumb-item active">Nouvelle transmission</li>
		</ol>
	</nav>
</div><!-- End Page Title -->

<section class="section dashboard">
	<div class="card sm mx-5 px-5">
		<div class="card-body">
			<h5 class="card-title">Formulaire de transmission</h5>

			<!-- Floating Labels Form -->
			<form class="row g-3" action="newTransmission_save.php" method="post">
				<div class="col-md-6">
					<div class="form-floating mb-3">
						<select class="form-select" required name="numPlainte" id="numPlainte" aria-label="Plainte à transmettre">
							<option disabled value="" selected>Sélectionner une plainte</option>
							<?php foreach ($plaintes as $plainte) : ?>
								<option value="<?php echo $plainte['numPlainte'] ?>">
									<?php
									switch (strlen($plainte['numPlainte'])) {
										case 1:
											echo 'PL00' . $plainte['numPlainte'] . ' | Objet : ' . $plainte['objetPlainte'];
											break;
										case 2:
											echo 'PL0' . $plainte['numPlainte'] . ' | Objet : ' . $plainte['objetPlainte'];
											break;
										case 3:
											echo 'PL' . $plainte['numPlainte'] . ' | Objet : ' . $plainte['objetPlainte'];
											break;
									}
									?>
								</option>
							<?php endforeach ?>
						</select>
						<label for="numPlainte">Plainte à transmettre</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-floating mb-3">
						<select class="form-select" required name="codeService" id="codeService" aria-label="Service de reception">
							<option disabled value="" selected>Sélectionner un service</option>
							<?php foreach ($services as $service) : ?>
								<option value="<?php echo $service['codeService'] ?>">
									<?php
									switch (strlen($service['codeService'])) {
										case 1:
											echo 'SER00' . $service['codeService'] . ' | Libellé : ' . $service['libelleService'];
											break;
										case 2:
											echo 'SER0' . $service['codeService'] . ' | Libellé : ' . $service['libelleService'];
											break;
										case 3:
											echo 'SER' . $service['codeService'] . ' | Libellé : ' . $service['libelleService'];
											break;
									}
									?>
								</option>
							<?php endforeach ?>
						</select>
						<label for="codeService">Service de reception</label>
					</div>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="reset" class="btn btn-secondary">Reset</button>
				</div>
			</form><!-- End floating Labels Form -->

		</div>
	</div>
</section>
<?php endblock() ?>