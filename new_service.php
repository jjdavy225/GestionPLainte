<?php include 'master.php' ?>

<?php startblock('title') ?>
Nouveau service
<?php endblock() ?>

<?php startblock('content') ?>
<div class="pagetitle">
    <h1>Enregistrement d'un nouveau service</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Services</li>
            <li class="breadcrumb-item active">Nouveau service</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="card sm mx-5 px-5">
        <div class="card-body">
            <h5 class="card-title">Formulaire d'enregistrement</h5>

            <!-- Floating Labels Form -->
            <form class="row g-3" action="newService_save.php" method="post">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" name="libelleService" class="form-control" id="libelleService" placeholder="Libellé du service">
                        <label for="libelleService">Libellé du service</label>
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