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
            <?php if (isset($_SESSION['userId'])) : ?>
                <h1 class="card-title text-danger">Dashboard en construction !!</h1>
            <?php else : ?>
                <h1 class="card-title text-center">Avez vous un compte ?</h1>
                <div class="row">
                    <span class="custT text-center text-bold fst-italic">Oui</span>
                    <a class="cust mx-auto p-3 rounded-pill col-lg-4 fw-bold text-center mt-3 bg-primary text-white" href="login.php">Connectez-vous !</a>
                </div>
                <div class="row mt-3 mb-4">
                    <span class="custT text-center text-bold fst-italic">Non, je suis un nouvel utilisateur.</span>
                    <a class="cust mx-auto p-3 rounded-pill col-lg-4 fw-bold text-center mt-3 bg-primary text-white" href="new_plainte.php">Enregistrer une plainte !</a>
                </div>
                <style>
                    .cust{
                        transition: all ease-in-out .3s;
                        background-color: #4c44d5 !important;
                    }

                    .custT{
                        color: #012970 !important;
                        /* font-weight: bolder; */
                    }

                    .cust:hover{
                        background-color: #1c194c !important;
                    }
                </style>
            <?php endif ?>
        </div>
    </div>
</section>
<?php endblock() ?>