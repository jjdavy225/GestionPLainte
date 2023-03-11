<?php include 'master.php' ?>

<?php startblock('title') ?>
Acceuil
<?php endblock() ?>

<?php startblock('content') ?>
<div class="pagetitle">
    <h1>Acceuil</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Acceuil</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="card sm">
        <div class="card-body">
            <h1 class="card-title text-center">Avez vous un compte ?</h1>
            <div>
                <span>Oui</span>
                <a href="login.php">Connectez-vous !</a>
            </div>
            <div>
                <span>Non, je suis un nouvel utilisateur.</span>
                <a href="new_plainte.php">Enregistrer une plainte !</a>
            </div>


        </div>
    </div>
</section>
<?php endblock() ?>