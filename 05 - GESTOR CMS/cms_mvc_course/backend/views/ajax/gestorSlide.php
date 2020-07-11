<?php
/*
  * Archivo que recibira las peticiones ajax que hagamos
  * */

//archivos para hacer las peticione
require_once '../../models/gestorSlide.php';
require_once '../../controllers/gestorSlide.php';


#CLASE Y METODOS
#-----------------------------------
class Ajax
{
    #SUBIR LA IMAGEN DEL SLIDE
    public $nombreImagen; //alacenara el nombre
    public $imagenTemporal;  //almacenrara el archivo como tal


    function gestorSlideAjax()
    {
        //alamacenamos en un array los datos que se pasan diamicament
        //con this apuntamos simepre a la nueva isntancia que se jecutas
        $datos = array(
            "nombreImagen" => $this->nombreImagen,
            "imagenTemporal" => $this->imagenTemporal
        );

        //en una varable invocamos a la clase de GestorSlide
        //y ejecutamos la funcion psando el parametro de los datos
        $respuesta = @GestorSlide::mostrarImagenController($datos);
        //devolvemos lo que nos cargo la respuesta
        echo $respuesta;
    }


    #ELIMINAR ITEM SLIDE
    public $idSlide;
    public $rutaSlide;

    function eliminarSlideAjax()
    {

        $datos = array(
            "idSlide" => $this->idSlide,
            "rutaSlide" => $this->rutaSlide
        );

        //invocamos la funcion del controllador
        $respuesta = @GestorSlide::eliminarSlideController($datos);
        echo $respuesta;
    }


    #ACTUALIZAR ITEM SLIDE
    public $enviarId;
    public $enviarTitulo;
    public $enviarDescripcion;
    public function actualizarSlideAjax()
    {
        //alamacenamos en un array los datos que se pasan diamicament
        //con this apuntamos simepre a la nueva isntancia que se jecutas
        $datos = array(
            "enviarId" => $this->enviarId,
            "enviarTitulo" => $this->enviarTitulo,
            "enviarDescripcion" => $this->enviarDescripcion
        );

        //en una varable invocamos a la clase de GestorSlide
        //y ejecutamos la funcion psando el parametro de los datos
        $respuesta = @GestorSlide::actualzarSlideController($datos);
        //devolvemos lo que nos cargo la respuesta
        echo $respuesta;
    }


    #ACTUALIZAR ORDEN DEL SLIDE
    public $actualizarOrdenSlide;
    public $actualizarOrdenItem;
    public function actualizarOrdenAjax()
    {
        $datos = [
            'ordenSlide' => $this->actualizarOrdenSlide,
            'ordenItem' => $this->actualizarOrdenItem
        ];

        //llamando al contrlador y le paso las variables que se pasen a por POST
        $respuesta = @GestorSlide::actualizarOrdenController($datos);

        echo $respuesta;

    }

}



/*LLAMAMIENTO DE LOS OBJETOS DE ESTA CLASE, YAPLICANDOLO*/


#OBJETOS DE CLASE
#-----------------------------------------
//creamos un objeto de esta CLASE

if (isset($_FILES['imagen']['name'])) {  //validamos que se halla enviado por AJAX la iamgen

    $a = NEW Ajax();
//asginamos a las varaible los valores que se enviaron por post
    $a->nombreImagen = $_FILES['imagen']['name']; //es file ya que lo que enviamos por POST en una iamgen
    // acedemos el nombre ya que se devuelve como array
    $a->imagenTemporal = $_FILES['imagen']['tmp_name']; //alcemnamos la imagen cargada
    $a->gestorSlideAjax();

}


#--------------------------------------------
//objeto de Eliminacion de slide
if (isset($_POST['idSlide'])) {  //validamos que se halla enviaod por post

    $b = NEW Ajax();
    $b->idSlide = $_POST['idSlide']; //le pasamos la variable que nos pasa el ajax por POST
    $b->rutaSlide = $_POST['rutaSlide'];
    $b->eliminarSlideAjax();

}


#--------------------------------------------
//objeto de actualizacion de slide
if (isset($_POST['enviarId'])) {
    $d = NEW Ajax();
    $d->enviarId = $_POST['enviarId'];
    $d->enviarTitulo = $_POST['enviarTitulo'];
    $d->enviarDescripcion = $_POST['enviarDescripcion'];
    $d->actualizarSlideAjax();  //ejecutando la funcion
}


#--------------------------------------------
//objeto de ORDENAR EL SLIDE
if(isset($_POST['actualizarOrdenSlide'])){
    $e = NEW Ajax();
    $e -> actualizarOrdenSlide = $_POST['actualizarOrdenSlide'];
    $e -> actualizarOrdenItem = $_POST['actualizarOrdenItem'];
    $e -> actualizarOrdenAjax();

}

?>


