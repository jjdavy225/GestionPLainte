<?php include 'master.php' ?>

<?php startblock('title') ?>
Nouvelle plainte
<?php endblock() ?>

<?php startblock('content') ?>
<div class="pagetitle">
    <h1>Enregistrement d'une nouvelle plainte</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Plaintes</li>
            <li class="breadcrumb-item active">Nouvelle plainte</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="card sm mx-5 px-5">
        <div class="card-body">
            <h5 class="card-title">Formulaire d'enregistrement</h5>

            <!-- Floating Labels Form -->
            <form class="row g-3" action="newPlainte_save.php" method="post">
                <legend class="col-form-label col-sm-4 pt-0">Souhaitez vous rester anonyme ?</legend>
                <div class="col-sm-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="anonyme" id="oui" value="oui">
                        <label class="form-check-label" for="oui">
                            Oui
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="anonyme" id="non" value="non" checked>
                        <label class="form-check-label" for="non">
                            Non
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" name="nomPlaignant" class="form-control" id="nomPlaignant" placeholder="Nom du plaignant">
                        <label for="nomPlaignant">Nom du plaignant</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" name="adressePlaignant" class="form-control" id="adressePlaignant" placeholder="Adresse du plaignant">
                        <label for="adressePlaignant">Adresse du plaignant</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="email" name="emailPlaignant" class="form-control" id="emailPlaignant" placeholder="Email">
                        <label for="emailPlaignant">Email</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" name="telPlaignant" class="form-control" id="telPlaignant" placeholder="Tel du plaignant">
                        <label for="telPlaignant">Tel du plaignant</label>
                    </div>
                </div>

                <h5 class="card-title mx-1">Description de la plainte</h5>


                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="date" readonly value="<?php echo date('Y-m-j') ?>" name="datePlainte" class="form-control" id="datePlainte" placeholder="Date de la plainte">
                        <label for="datePlainte">Date de la plainte</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" name="objetPlainte" class="form-control" id="objetPlainte" placeholder="Objet de la plainte">
                        <label for="objetPlainte">Objet de la plainte</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control" name="descriptionPlainte" placeholder="Description de la plainte" id="descriptionPlainte" style="height: 80px;"></textarea>
                        <label for="descriptionPlainte">Description de la plainte</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select class="form-select" name="modeEmission" id="modeEmission" aria-label="Mode d'émision">
                            <option value="Email">Email</option>
                            <option value="Message">Message</option>
                            <option value="Appel téléphonique">Appel téléphonique</option>
                        </select>
                        <label for="modeEmission">Mode d'émision</label>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form><!-- End floating Labels Form -->

        </div>
    </div>
    <script>
        const oui = document.getElementById("oui")
        const non = document.getElementById("non")
        const nomPlaignant = document.getElementById("nomPlaignant")
        const adressePlaignant = document.getElementById("adressePlaignant")
        const emailPlaignant = document.getElementById("emailPlaignant")
        const telPlaignant = document.getElementById("telPlaignant")
        non.addEventListener("change", (function() {
            nomPlaignant.disabled = false
            adressePlaignant.disabled = false
            emailPlaignant.disabled = false
            telPlaignant.disabled = false
        }))
        oui.addEventListener("change", (function() {
            nomPlaignant.disabled = true
            nomPlaignant.value = ""
            adressePlaignant.disabled = true
            adressePlaignant.value = ""
            emailPlaignant.disabled = true
            emailPlaignant.value = ""
            telPlaignant.disabled = true
            telPlaignant.value = ""
        }))
    </script>
</section>
<?php endblock() ?>