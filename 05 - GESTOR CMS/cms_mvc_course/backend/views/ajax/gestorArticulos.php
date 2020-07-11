<?php

//importando el contrllador
require_once '../../controllers/gestorArticulos.php';
require_once '../../models/gestorArticulos.php';

#--------------------------------------------------------
//CLASES O METEDOSO
class Ajax
{
    #SUBIR LA IMAGEN DEL ARTICULO
    public $imagenTemporal;

    public function gestorArticulosAjax()
    {
        //capturamos en una variable lo que se le pase al objeto de la calse
        $datos = $this->imagenTemporal;

        //invocando a la funcion del contrlador y pasando lo que pase el input file
        $respuesta = @GestorArticulos::mostrarImagenController($datos);

        echo $respuesta;
    }


    #FUNCTION DE ACTUALIZAR EL ORDEN
    public $actualizarOrdenArticulos;
    public $actualizarOrdenItem;

    public function actualizarOrdenAjax()
    {
        //capturo los datos
        $datos = [
            'ordenArticulos' => $this->actualizarOrdenArticulos,
            'ordenItem' => $this->actualizarOrdenItem
        ];

        //paso los datos al controller y resibvo por respuesta el query con el html
        $respuesta  = @GestorArticulos::actualizarOrdenController($datos);

        echo $respuesta;
    }


}


#--------------------------------------------------------
//OBJETOS DE CLASE

#RESIVIENDO LO QUE PASE AL SUBIR LA IAMGEN EL AJAX
if (isset($_FILES['imagen']['tmp_name'])) {
    $a = NEW Ajax();
    $a->imagenTemporal = $_FILES['imagen']['tmp_name'];
    $a->gestorArticulosAjax();
}

#RESIVIENDO L APETICION DE ACTUALZIAR ORDEN DE ARTICULOS
if (isset($_POST['actualizarOrdenArticulos'])) {
    $b = NEW Ajax();
    $b->actualizarOrdenArticulos = $_POST['actualizarOrdenArticulos'];
    $b->actualizarOrdenItem = $_POST['actualizarOrdenItem'];
    $b->actualizarOrdenAjax();
}

?>