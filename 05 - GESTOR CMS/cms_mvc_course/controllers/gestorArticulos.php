<?php

class Articulos
{

    #FUNCTION QUE DEVULEVE LOS ARTICULOS DE LA BD
    public function seleccionarArticulosController()
    {
        $respuesta = @ArticulosModel::MostrarArticulosFronted();
        echo '<ul>';
        foreach ($respuesta as $row => $dato) {

            echo '<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                <img src="backend/' . $dato['ruta'] . '" class="img-thumbnail">
                    <h1>' . $dato['titulo'] . '</h1>
                    <p>' . $dato['introduccion'] . '</p>
                    <a href="#articulo' . $dato['id'] . '" data-toggle="modal">
                        <button class="btn btn-default">Leer Más</button>
                        </a>
                <hr>
             </li>

             ';;
        }

        echo '</ul>';


        foreach ($respuesta as $row => $dato) {

            echo ' 
            <div id = "articulo' . $dato['id'] . '" class="modal fade" >
                      <div class="modal-dialog modal-content" >
                         <div class="modal-header" style = "border:1px solid #eee" >
                             <button type = "button" class="close" data-dismiss = "modal" >&times;</button >
                             <h3 class="modal-title" > ' . $dato['titulo'] . ' </h3 >
                         </div >
                     <div class="modal-body" style = "border:1px solid #eee" >
                         <img src = "backend/' . $dato['ruta'] . '" width = "100%" style = "margin-bottom:20px" >
                         <p class="parrafoContenido text-justify" > ' . $dato['contenido'] . ' </p >
                     </div >
                     <div class="modal-footer" style = "border:1px solid #eee" >
                     <button type = "button" class="btn btn-default" data-dismiss = "modal" > Cerrar</button >
                 </div>
             </div>
         </div>';



        }


    }


}


?>