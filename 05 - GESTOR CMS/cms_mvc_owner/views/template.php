<?php




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FrontEnd</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="views/views/images/icono.jpg">

    <link rel="stylesheet" href="views/css/bootstrap.min.css">
    <link rel="stylesheet" href="views/css/font-awesome.min.css">
    <link rel="stylesheet" href="views/css/style.css">
    <link rel="stylesheet" href="views/css/fonts.css">
    <link rel="stylesheet" href="views/css/cssFancybox/jquery.fancybox.css">
    <link rel="stylesheet" href="views/css/sweetalert.css">

    <script src="views/js/jquery-2.2.0.min.js"></script>
    <script src="views/js/bootstrap.min.js"></script>
    <script src="views/js/jquery.fancybox.js"></script>
    <script src="views/js/animatescroll.js"></script>
    <script src="views/js/jquery.scrollUp.js"></script>
    <script src="views/js/sweetalert.min.js"></script>

</head>

<body>

<div class="container-fluid">

    <!--=====================================
    CABEZOTE
    ======================================-->

    <?php require_once 'views/modules/cabezote.php';  ?>

    <!--====  Fin de CABEZOTE  ====-->

    <!--=====================================
    SLIDE
    ======================================-->
    <?php require_once 'views/modules/slide.php'; ?>

    <!--====  Fin de SLIDE  ====-->

    <!--=====================================
    TOP
    ======================================-->

    <?php require_once 'views/modules/top.php'; ?>

    <!--====  Fin de TOP  ====-->

    <!--=====================================
    GALERIA
    ======================================-->

    <?php require_once 'views/modules/galeria.php'; ?>

    <!--====  Fin de GALERIA  ====-->

    <!--=====================================
    ARTÍCULOS
    ======================================-->

    <?php require_once 'views/modules/articulos.php'; ?>

    <!--====  Fin de ARTÍCULOS  ====-->

    <!--=====================================
    VIDEOS
    ======================================-->

    <?php require_once 'views/modules/videos.php'; ?>

    <!--====  Fin de VIDEOS  ====-->

    <!--=====================================
        CONTÁCTENOS
    ======================================-->
    <?php require_once 'views/modules/contactenos.php'; ?>

    <!--====  Fin de CONTÁCTENOS ====-->

    <!--=====================================
        ARTÍCULO MODAL
    ======================================-->

    <?php require_once 'views/modules/articuloModal.php'; ?>


    <!--====  Fin de ARTICULO MODAL ====-->

</div>




<script src="views/js/script.js"></script>

</body>
</html>


