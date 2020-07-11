<?php


class GestorGaleria
{


    #FUNCION DE MOSTRAR LA IAMGEN
    public function mostrarImagenController($datos)
    {
        //Captuando alto y ancho imagen, de todas las iamgenes que vienen dentro de la variable datos
        //no se necesita de for ya que list lo hace automatico
        list($ancho, $alto) = getimagesize($datos);

        if ($ancho < 1024 || $alto < 768) {
            echo "fallo";
        } else {
            //variable aletoria
            $aleatorio = mt_rand(100, 9999);
            //colocamos la ruta donde se guardara a imagen
            $ruta = "../../views/images/galeria/galeria" . $aleatorio . ".jpg";


            //transformaremos procpocioanlemnte la iamgen, al alto y ancho que necsitamos
            $nuevo_Ancho = 1024;
            $nuevo_alto = 768;

            //creamos la iamgen
            $origen = imagecreatefromjpeg($datos);

            //creanis una imagen de color verdadero, para rreporocionar los tamaños
            $destino = imagecreatetruecolor($nuevo_Ancho, $nuevo_alto);

            //crearemos el archivo con la propoorcion dada de imagen
            //imagecopyresized($destino , $origen, posicion x, poscion y, origen x, origen y, destino ancho, destino alto, origen ancho, origen alto)
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevo_Ancho, $nuevo_alto, $ancho, $alto);

            //creacion final de la image
            imagejpeg($destino, $ruta);


            //LLmandando la funcion QUE INSERTA
            $subiendo = @GestorGaleriaModel::subirImagenGaleriaModel($ruta, 'galeria');

            if ($subiendo == 'ok') {
                //llamando a la funcion que trae las rutas de la imagenes
                $respuesta = @GestorGaleriaModel::mostrarImagenGaleriaModel($ruta, 'galeria');

                echo $respuesta["ruta"];
            } else {
                echo 'error';
            }
        }
    }


    #FUNCION QUE DEVUELVE TODAS LAS IMAGENES AL CARGAR LA PAGINA
    public function mostrarTodasLasImagenesGaleria()
    {
        $respuesta = @GestorGaleriaModel::muestraTodasLasImagenesGaleria('galeria');

        //substr($string, $cantidad);  //quita la cantidad de caracteres que le especifiqremos
        //creo un atritubot ruta, que despues servira para eliminar la ruta de la imagen
        /*recorriendo cada respuesta*/
        foreach ($respuesta as $dato) {
            echo '<li id="' . $dato['id'] . '" class="bloqueGaleria">
            <span class="fa fa-times eliminarFoto" ruta="' . $dato['ruta'] . '"></span>
            <a rel="grupo" href="' . substr($dato['ruta'], 6) . '">
                <img src="' . substr($dato['ruta'], 6) . '" class="handleImage">
            </a>
        </li>';
        }


    }

    #FUNCION QUE ELIMINAR POR ID , LA IMAGEN DE GALERIA
    public function eliminarGaleriaController($datos)
    {
        //eliminado la ruta en la bd
        $respuesta = @GestorGaleriaModel::eliminarGaleriaModel($datos, 'galeria');

        //eliminado la iamgen desde el server;
        unlink($datos['rutaGaleria']);  //la variable ya viene con toda la ruta ../../views  ....
        echo $respuesta;
    }


    #FUNCION QUE ACTUALIZARA EL ORDEN DE LA IMAGEN
    public function actualizarOrdenController($datos)
    {



        //ejecutando el update sobre el orden de las imagenes
        $actualizar = @GestorGaleriaModel::actualizarOrdenModel($datos, "galeria");


        if ($actualizar == 'ok') {

            //alamaceno el nuevo orden con la ruta de las img
            $respuesta = @GestorGaleriaModel::seleccionarOrdenModel("galeria");

            foreach ($respuesta as $dato) {
                echo '<li id="' . $dato['id'] . '" class="bloqueGaleria">
            <span class="fa fa-times eliminarFoto" ruta="' . $dato['ruta'] . '"></span>
            <a rel="grupo" href="' . substr($dato['ruta'], 6) . '">
                <img src="' . substr($dato['ruta'], 6) . '" class="handleImage">
            </a>
            </li>';
            }


        } else {
            echo "error";
        }


    }


}

?>