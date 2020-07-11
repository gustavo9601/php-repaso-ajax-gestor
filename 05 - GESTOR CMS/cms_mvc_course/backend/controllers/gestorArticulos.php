<?php

class GestorArticulos
{

    #FUNCION QUE DEVOLVERA LA IAMGEN QUE SE ASO POR EL AJAX
    public function mostrarImagenController($datos)
    {
        //capturamos en una lista el ancho y alto del array datos con la informacion de la iamgne
        //indice 0 y 1
        list($ancho, $alto) = getimagesize($datos);

        if ($ancho < 800 || $alto < 400) {
            echo 0;
        } else {
            //numero aleatorio
            $aleatorio = mt_rand(100, 999);
            //ruta
            $ruta = '../../views/images/articulos/temp/articulo' . $aleatorio . '.jpg';

            //cremaos la imagen
            $origen = imagecreatefromjpeg($datos);

            //cortamos la iagen
            $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 800, "height" => 400]);

            //guarfamos la imagen
            imagejpeg($destino, $ruta);

            echo $ruta; //devolvemos la ruta de la imgen para que el ajax la acrgue
        }

    }


    #FUNCION PARA ALMACENAR EL ARTIUCLO
    public function guardarArticulo()
    {

        //validando si se envio el post
        if (isset($_POST['tituloArticulo'])) {
            //capturando lo enviado por post
            $imagen = $_FILES['imagen']['tmp_name'];

            //variable con el metodo glob -> permite seleccionar todos lo archivos del directorio
            $archivosEnCarpeta = glob('views/images/articulos/temp/*');

            //borrando todo lo que contenga ahora el array archivosEnCarpeta
            foreach ($archivosEnCarpeta as $file) {
                //con unlink elimina cualquier archivo
                unlink($file);
            }

            //creando el nombre de la imagen a subir
            $aleatorio = mt_rand(100, 999); //numero aleatorio
            $ruta = 'views/images/articulos/articulo' . $aleatorio . '.jpg'; //ruta + nombre de archivo
            $origen = imagecreatefromjpeg($imagen); //creamos la imagen de temoporal a reals
            $destino = imagecrop($origen, ['x' => 0, 'y' => 0, 'width' => 800, 'height' => 400]);//recorte de la iamgen
            imagejpeg($destino, $ruta); //creamos y mandamos la imagen creada a la ruta


            //llevando a la bd la informacion
            $datosController = [  //varaible que almacena lo que se paso por POST
                'titulo' => $_POST['tituloArticulo'],
                'introduccion' => $_POST['introArticulo'] . "...",  //los puntos solo sirven para agrelarlo en la vista
                'ruta' => $ruta,
                'contenido' => $_POST['contenidoArticulo']
            ];
            //llamando la funcion de insert del modelo
            $respuesta = @GestorArticulosModel::guardarArticuloModel($datosController, 'articulos');


            // var_dump($respuesta);

            //si lo que devuelve es true
            if ($respuesta) {
                //mostramos una alerta suave
                echo '<script>
                        swal({
                            title: "!OK",
                            text: "Se creao el Articulo Correctamente !",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        },
                        function (isConfirm) {  //validamos que se halla confirmado
                            if (isConfirm) {
                                window.location = "articulos";  //si se confirmo se redireccionara a slide, ya que con el .htacces solo debemos pasar el final
                            }
                        })
                        </script>';
            } else {

                echo $respuesta;
            }

        }
    }


    #FUNCION QUE MOSTRARA LOS ARTICULOS EN EL BACKEND
    public function mostrarArticulos()
    {
        //llamando la funcion del query que devolverea los artiuclso
        $respuesta = @GestorArticulosModel::mostrarArticulosModel('articulos');

        //recorriendo la respuesta

        foreach ($respuesta as $item) {

            echo '<li id="' . $item["id"] . '" class="bloqueArticulo">
                            <span>
                            <a href="index.php?action=articulos&idBorrar=' . $item["id"] . '&rutaImagen=' . $item["ruta"] . '">
                                <i class="fa fa-times btn btn-danger "></i>
                             </a>
                            <i class="fa fa-pencil btn btn-primary editarArticulo"></i>
                            </span>
                <img src="' . $item["ruta"] . '" class="img-thumbnail">
                <h1>' . $item["titulo"] . '</h1>
                <p>' . $item["introduccion"] . '</p>
                <input type="hidden" value="' . $item["contenido"] . '">
                <a href="#articulo' . $item["id"] . '" data-toggle="modal">
                    <button class="btn btn-default">Leer Más</button>
                </a>
                <hr>
            </li>
            <div id="articulo' . $item["id"] . '" class="modal fade">
                 <div class="modal-dialog modal-content">
                 <div class="modal-header" style="border:1px solid #eee">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">' . $item["titulo"] . '</h3>
            </div>
            <div class="modal-body" style="border:1px solid #eee">
                <img src="' . $item["ruta"] . '" width="100%" style="margin-bottom:20px">
                <p class="parrafoContenido">' . $item["introduccion"] . '</p>
             </div>
             <div class="modal-footer" style="border:1px solid #eee">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>';
        }

    }


    #FUNCION QUE ELIMINARA LOS ARTICULOS
    public function eliminarArticuloController()
    {
        //validamos que la valible get venga llena
        if (isset($_GET['idBorrar'])) {

            //por get se pasa, el id a borrar, la url de la imagen a borrar
            unlink($_GET['rutaImagen']);  //eliminamos la imagen que se pase por el parametro get
            //capturamos en una variabl ele id a borrar
            $datosController = $_GET['idBorrar'];


            //llamando la funcion que eliminara en la bd el registro
            $respuesta = @GestorArticulosModel::borrarArticuloModel($datosController, 'articulos');

            //validando lo que nos devuelva la respuesta
            if ($respuesta == "ok") {
                echo '<script>
                        swal({
                            title: "!OK",
                            text: "El articulo se borro correctanemnte!",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        },
                        function (isConfirm) {  //validamos que se halla confirmado
                            if (isConfirm) {
                                window.location = "articulos";  //si se confirmo se redireccionara a slide, ya que con el .htacces solo debemos pasar el final
                            }
                        })
                        </script>';
            }

        }
    }


    #FUNCION DE ACTUALIZAR EL ARTICULO
    public function editarArticuloController()
    {


        if (isset($_POST['editarTitulo'])) {


            //validamos si la varaible de file viene llena, es decirr que se cambio la imagen
            //editar Imagen se lo asignamos cada vez que demos click sobre cambiar la iamgen
            if (isset($_FILES['editarImagen']['tmp_name'])) {
                $ruta = "";
                //guardamos los datos que nos trae el post
                $imagen = $_FILES['editarImagen']['tmp_name'];
                // creamos una varaible aleatoria para asignarle el nombre a la imagen
                $aleatoio = mt_rand(100, 999);
                //ruta donde se alacenara la iamgen, mas el nomnbre al final de la imagen que se le asiganara
                $ruta = 'views/images/articulos/articulo' . $aleatoio . '.jpg';
                //guardamos en una varaible la creacion de la imagen
                $origen = imagecreatefromjpeg($imagen);
                //recortamos la imagen anteriormente creada
                $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 800, "height" => 400]);
                //creamos la imagen con lo que contenga, y a la ruta desiganada con el nomnbre
                imagejpeg($destino, $ruta);


                /*
                 * Vamos a borrar los temoporales generados
                 * **/
                $borrar = glob('views/images/articulos/temp/*'); //glob captura en un array el nombre con ruta de todo lo que encuentr en el directorio
                //con un foreach vamos a eliminar cada uno de los temroporales
                foreach ($borrar as $imagenAEliminar) {
                    unlink($imagenAEliminar);  //con unlik se elimina lo que conteenga el directorio y el nombre
                }
            }

            //aqui validamos si se cambio la imagen, entonces eleiminamos la imagen del servidor, y modificamos
            //la variable ruta
            if ($ruta == "") {
                $ruta = $_POST['fotoAntigua'];
            } else {
                unlink($_POST['fotoAntigua']); //eliminamo la imagen, por que ya se reemplezo
            }

            //array donde alamcenamos lo que nos envia el ajax
            $datosController = array(
                "id" => $_POST['id'],
                "titulo" => $_POST['editarTitulo'],
                "introduccion" => $_POST['editarIntroduccion'],
                "ruta" => $ruta,
                "contenido" => $_POST['editarContenido']
            );


            //invocamos al modelo para que realice el update
            $respuesta = @GestorArticulosModel::editarArticuloModel($datosController, 'articulos');


            //validando lo que nos devuelva la respuesta
            if ($respuesta == "ok") {
                echo '<script>
                        swal({
                            title: "!OK",
                            text: "El articulo se Actualizo correctamente!",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        },
                        function (isConfirm) {  //validamos que se halla confirmado
                            if (isConfirm) {
                                window.location = "articulos";  //si se confirmo se redireccionara a slide, ya que con el .htacces solo debemos pasar el final
                            }
                        })
                        </script>';
            } else {
                //si no se ejcuta que nos retoner el error
                echo $respuesta;
            }

        }
    }




    #FUNCION ACTUALIZAR EL ORDEN DE LOS ITEM
    #______________________________________
    public function actualizarOrdenController($datos)
    {

        //llamamos la funcion de actualizacion del Modelo
        $actulizo = @GestorArticulosModel::actualizarOrdenoModel($datos);

        if ($actulizo == 'ok') {
            //otra funcion me devuelve todo el query con los item organizados
            $respuesta = @GestorArticulosModel::seleccionarOrdenoModel('articulos');


            foreach ($respuesta as $row => $item) {
                echo '<li id="' . $item["id"] . '" class="bloqueArticulo">
                            <span>
                            <a href="index.php?action=articulos&idBorrar=' . $item["id"] . '&rutaImagen=' . $item["ruta"] . '">
                                <i class="fa fa-times btn btn-danger "></i>
                             </a>
                            <i class="fa fa-pencil btn btn-primary editarArticulo"></i>
                            </span>
                <img src="' . $item["ruta"] . '" class="img-thumbnail">
                <h1>' . $item["titulo"] . '</h1>
                <p>' . $item["introduccion"] . '</p>
                <input type="hidden" value="' . $item["contenido"] . '">
                <a href="#articulo' . $item["id"] . '" data-toggle="modal">
                    <button class="btn btn-default">Leer Más</button>
                </a>
                <hr>
            </li>
            <div id="articulo' . $item["id"] . '" class="modal fade">
                 <div class="modal-dialog modal-content">
                 <div class="modal-header" style="border:1px solid #eee">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">' . $item["titulo"] . '</h3>
            </div>
            <div class="modal-body" style="border:1px solid #eee">
                <img src="' . $item["ruta"] . '" width="100%" style="margin-bottom:20px">
                <p class="parrafoContenido">' . $item["introduccion"] . '</p>
             </div>
             <div class="modal-footer" style="border:1px solid #eee">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>';
            }
        } else {
            echo 'error';
        }


    }


}

?>