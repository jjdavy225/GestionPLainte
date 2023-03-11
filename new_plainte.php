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
            <h5 class="card-title">Description de la plainte</h5>

            <!-- Floating Labels Form -->
            <form class="row g-3" action="newPlainte_save.php" method="post" enctype="multipart/form-data">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input required type="date" readonly value="<?php echo date('Y-m-d') ?>" name="datePlainte" class="form-control" id="datePlainte" placeholder="Date de la plainte">
                        <label for="datePlainte">Date de la plainte</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input required type="text" name="objetPlainte" class="form-control" id="objetPlainte" placeholder="Objet de la plainte">
                        <label for="objetPlainte">Objet de la plainte</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <textarea required class="form-control" name="descriptionPlainte" placeholder="Description de la plainte" id="descriptionPlainte" style="height: 80px;"></textarea>
                        <label for="descriptionPlainte">Description de la plainte</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form">
                        <label for="pieceJointe" class="text-secondary" style="font-size:.9em">Ajouter une pièce jointe (facultatif)</label>
                        <input type="file" accept="application/pdf" name="pieceJointe" class="form-control" id="pieceJointe" placeholder="Pièce jointe">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select required class="form-select" name="modeEmission" id="modeEmission" aria-label="Mode d'émision">
                            <option disabled selected value="">Choisissez une option</option>
                            <option value="Email">Email</option>
                            <option value="Message">Message</option>
                            <option value="Appel téléphonique">Appel téléphonique</option>
                        </select>
                        <label for="modeEmission">Mode d'émision</label>
                    </div>
                </div>

                <div class="d-flex flex-column justify-content-center align-items-center">
                    <legend class="form-label text-center" style="font-size: 1em">Souhaitez vous rester anonyme ?</legend>
                    <div class="col">
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
                </div>

                <div class="row g-3" id="plaignantForm">
                    <h5 class="card-title mx-2">Description du plaignant</h5>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input required type="text" name="nomPlaignant" class="form-control" id="nomPlaignant" placeholder="Nom du plaignant">
                            <label for="nomPlaignant">Nom du plaignant</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input required type="text" name="adressePlaignant" class="form-control" id="adressePlaignant" placeholder="Adresse du plaignant">
                            <label for="adressePlaignant">Adresse du plaignant</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input required type="email" name="emailPlaignant" class="form-control" id="emailPlaignant" placeholder="Email">
                            <label for="emailPlaignant">Email</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input required type="text" name="telPlaignant" class="form-control" id="telPlaignant" placeholder="Tel du plaignant">
                            <label for="telPlaignant">Tel du plaignant</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input required type="text" name="login" class="form-control" id="login" placeholder="Nom d'utilisateur">
                            <label for="login">Nom d'utilisateur</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input required type="password" name="password" class="form-control" id="password" placeholder="Mot de passe" onkeyup="check();">
                            <label for="password">Mot de passe</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input required type="password" class="form-control" id="confirm_password" placeholder="Confirmation MDP" onkeyup="check();">
                            <label for="password">Confirmation MDP</label>
                        </div>
                        <span id="message"></span>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                </div>


            </form><!-- End floating Labels Form -->

        </div>
    </div>
    <script>
        var check = function() {
            if (document.getElementById('password').value ==
                document.getElementById('confirm_password').value) {
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = 'Semblable';
            } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'Insemblable';
            }
        }

        const oui = document.getElementById("oui")
        const non = document.getElementById("non")
        const plaignantForm = document.getElementById("plaignantForm")
        const inputElements = plaignantForm.getElementsByTagName('input');
        non.addEventListener("change", (function() {
            plaignantForm.removeAttribute("style")
            for (let i = 0; i < inputElements.length; i++) {
                inputElements[i].setAttribute('required', '');
            }
        }))
        oui.addEventListener("change", (function() {
            plaignantForm.style.display = "none"
            for (let i = 0; i < inputElements.length; i++) {
                inputElements[i].removeAttribute('required');
            }
        }))
    </script>
</section>
<?php endblock() ?>