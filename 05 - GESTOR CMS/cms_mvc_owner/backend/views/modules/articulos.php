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
ARTÍCULOS ADMINISTRABLE
======================================-->

<div id="seccionArticulos" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">

    <button id="btnAgregarArticulo" class="btn btn-info btn-lg">Agregar Artículo</button>

    <!--==== AGREGAR ARTÍCULO  ====-->

    <div id="agregarArtículo" style="display: none">

        <!--
        enctype="multipart/form-data"  -> me permite informarle al navegador que va a recibir multiples tipos de archivos
        -->
        <form action="" method="post" enctype="multipart/form-data">
            <input name="tituloArticulo" type="text" placeholder="Título del Artículo" class="form-control" required>

            <textarea name="introArticulo" maxlength="170" name="" id="" cols="30" rows="5"
                      placeholder="Introducción del Articulo"
                      class="form-control" required></textarea>

            <input type="file" name="imagen" class="btn btn-default" id="subirFoto" required>

            <p>Tamaño recomendado: 800px * 400px, peso máximo 2MB</p>

            <div id="arrastreImagenArticulo">
                <!--<div id="imagenArticulo"><img src="views/images/articulos/landscape01.jpg" class="img-thumbnail"></div>-->
            </div>

            <textarea name="contenidoArticulo" id="" cols="30" rows="10" placeholder="Contenido del Articulo"
                      class="form-control" required></textarea>

            <input type="submit" id="guardarArticulo" class="btn btn-primary" value="Guardar Artículo">
        </form>
    </div>

    <?php
    //invocando l afuncion que ejecutara el controllador al pasar po post
    $crearArticulo = NEW GestorArticulos();
    $crearArticulo->guardarArticulo();
    ?>

    <hr>

    <!--==== EDITAR ARTÍCULO  ====-->

    <ul id="editarArticulo">

        <?php
        //invocando l afuncion que ejecutara el controllador y traera los articulos
        $mostrarArticulo = NEW GestorArticulos();
        //funcion que muestra los artituclos
        $mostrarArticulo->mostrarArticulos();
        //funcion que elimina los artiuculos cuando escucha la peticion get
        $mostrarArticulo->eliminarArticuloController();
        //funcion que permite editar el artiuclo
        $mostrarArticulo->editarArticuloController();
        ?>

        <!--       <li>
                            <span>
                            <i class="fa fa-times btn btn-danger"></i>
                            <i class="fa fa-pencil btn btn-primary"></i>
                            </span>
                <img src="views/images/articulos/landscape02.jpg" class="img-thumbnail">
                <h1>Lorem Ipsum</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <a href="#articulo1" data-toggle="modal">
                    <button class="btn btn-default">Leer Más</button>
                </a>

                <hr>

            </li>

            <li>
                            <span>
                            <button class="btn btn-primary pull-right">Guardar</button>
                            </span>

                <div id="editarImagen"><span class="fa fa-times"></span><img src="views/images/articulos/landscape03.jpg" class="img-thumbnail"></div>

                <input type="text" value="Lorem Ipsum">

                <textarea cols="30" rows="5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</textarea>

                <textarea name="" id="editarContenido" cols="30" rows="10">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</textarea>

                <hr>

            </li>
        -->
    </ul>

    <button id ="ordenarArticulos" class="btn btn-warning pull-right" style="margin:10px 30px">Ordenar Artículos</button>
    <button id ="guardarOrdenArticulos" class="btn btn-primary pull-right" style="display: none; margin:10px 30px">Guardar Orden</button>

</div>

<!--====  Fin de ARTÍCULOS ADMINISTRABLE  ====-->

<!--=====================================
ARTÍCULO MODAL
======================================-->

<!--<div id="articulo1" class="modal fade">

    <div class="modal-dialog modal-content">

        <div class="modal-header" style="border:1px solid #eee">

            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Lorem Ipsum</h3>

        </div>

        <div class="modal-body" style="border:1px solid #eee">

            <img src="images/articulos/landscape02.jpg" width="100%" style="margin-bottom:20px">
            <p class="parrafoContenido">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

        </div>

        <div class="modal-footer" style="border:1px solid #eee">

            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>

    </div>

</div>-->

<!--====  Fin de ARTICULO MODAL ====-->