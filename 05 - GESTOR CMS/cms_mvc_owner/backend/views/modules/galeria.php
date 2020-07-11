<?php
session_start(); //iniciamos sesion
//validamos si esa variable trae algo y que no sa falsa
if (@!isset($_SESSION['validar']) && @!$_SESSION['validar']) {
    //redireccionamos a igreso
    //el .htacces remplaza -> index.php?action= solo a ingreso
    header('Location: ingreso');
    exit(); //salimos del script
}

require_once 'views/modules/botonera.php';
require_once 'views/modules/cabezote.php';

?>


<!--=====================================
GALERIA ADMINISTRABLE
======================================-->

<div id="galeria" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">

    <hr>

    <p><span class="fa fa-arrow-down"></span> Arrastra aquí tu imagen, tamaño recomendado: 1024px * 768px</p>

    <ul id="lightbox">

        <?php

        $imagenesGaleria = new GestorGaleria();
        $imagenesGaleria->mostrarTodasLasImagenesGaleria();

        ?>

        <!--
        <li>
            <span class="fa fa-times"></span>
            <a rel="grupo" href="images/galeria/photo01.jpg">
                <img src="views/images/galeria/photo01.jpg">
            </a>
        </li>


    --></ul>

    <button id="ordenarGaleria" class="btn btn-warning pull-right" style="margin:10px 30px">Ordenar Imágenes</button>
    <button id="guardarGaleria" class="btn btn-primary pull-right" style="display:none;margin:10px 30px">Guardar Orden
        Imágenes
    </button>

</div>

<!--====  Fin de GALERIA ADMINISTRABLE  ====-->