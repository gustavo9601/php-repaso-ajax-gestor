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
VIDEOS ADMINISTRABLE
======================================-->

<div id="videos" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
    <p style="margin-top: 2rem">Subir solo videos en formato MP4 y no exceda el peso de 6 MB</p>
    <form method="post" action="" enctype="multipart/form-data">

        <input type="file" id="subirVideo" required name="video" class="btn btn-default">

        <!--     <input type="submit"  value="Subir Video" class="btn btn-info">-->

    </form>


    <ul id="galeriaVideo">

        <?php
        $llamandoGestorVideos = new GestorVideos();
        $llamandoGestorVideos->mostrarVideoVistaController();


        ?>

        <!-- <li>
             <span class="fa fa-times"></span>
             <video controls>
                 <source src="views/videos/video01.mp4" type="video/mp4">
             </video>
         </li>

         <li>
             <span class="fa fa-times"></span>
             <video controls>
                 <source src="views/videos/video02.mp4" type="video/mp4">
             </video>
         </li>

         <li>
             <span class="fa fa-times"></span>
             <video controls>
                 <source src="views/videos/video03.mp4" type="video/mp4">
             </video>
         </li>

         <li>
             <span class="fa fa-times"></span>
             <video controls>
                 <source src="views/videos/video04.mp4" type="video/mp4">
             </video>
         </li>-->

    </ul>


    <button class="btn btn-warning " style="margin:10px 30px;" id="ordenarVideos">Ordenar Videos</button>
    <button class="btn btn-success " style="display:none;margin:10px 30px;" id="guardarVideos">Guardar Orden Videos</button>

</div>


<!--====  Fin de VIDEOS ADMINISTRABLE  ====-->