<?php
session_start();
?>

<?php require_once 'ti.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>
        <?php startblock('title') ?>
        <?php endblock() ?>
    </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Gestion de plaintes</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <?php if (isset($_SESSION['userName'])) : ?>
                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            <img src="assets/img/avatar.svg" alt="Profile" class="rounded-circle">
                            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['userName'] ?></span>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6><?php echo $_SESSION['userName'] ?></h6>
                                <span><?php echo $_SESSION['accountType'] . "(e)" ?></span>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- <li>
                                <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                    <i class="bi bi-gear"></i>
                                    <span>Account Settings</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li> -->

                            <li>
                                <form class="dropdown-item d-flex align-items-center" action="logout.php" method="post">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <button class="dropdown-item d-flex align-items-center" type="submit"><span>Sign Out</span></button>
                                </form>
                            </li>

                        </ul>
                    <?php else : ?>
                        <a class="fw-bold fst-italic border-start border-primary p-1" style="font-size: 14px;" href="login.php">
                            Connectez-vous !
                        </a>
                    <?php endif ?>


                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="bi bi-grid"></i>
                    <span>Acceuil</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#plaintes-nav" data-bs-toggle="collapse">
                    <i class="bi bi-pencil-square"></i><span>Plaintes</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="plaintes-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="new_plainte.php">
                            <i class="bi bi-plus"></i><span>Nouvelle plainte</span>
                        </a>
                    </li>
                    <li>
                        <a href="liste_plainte.php">
                            <i class="bi bi-plus"></i><span>Liste des plaintes</span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php if (isset($_SESSION['accountType'])) : ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#services-nav" data-bs-toggle="collapse">
                        <i class="bi bi-house-gear"></i><span>Services</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="services-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="new_service.php">
                                <i class="bi bi-plus"></i><span>Nouveau service</span>
                            </a>
                        </li>
                        <li>
                            <a href="liste_service.php">
                                <i class="bi bi-plus"></i><span>Liste des services</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#transmissions-nav" data-bs-toggle="collapse">
                        <i class="bi bi-share"></i><span>Transmissions</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="transmissions-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="new_transmission.php">
                                <i class="bi bi-plus"></i><span>Nouvelle transmission</span>
                            </a>
                        </li>
                        <li>
                            <a href="liste_transmission.php">
                                <i class="bi bi-plus"></i><span>Liste des transmissions</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#reponses-nav" data-bs-toggle="collapse">
                        <i class="bi bi-check2-square"></i><span>Réponses</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="reponses-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="new_reponse.php">
                                <i class="bi bi-plus"></i><span>Nouvelle réponse</span>
                            </a>
                        </li>
                        <li>
                            <a href="liste_reponse.php">
                                <i class="bi bi-plus"></i><span>Liste des réponses</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif ?>


            <!-- End Components Nav -->
        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        <?php startblock('content') ?>
        <?php endblock() ?>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>