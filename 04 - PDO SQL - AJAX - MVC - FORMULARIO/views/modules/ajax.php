<?php
/*
 * ARCHIVO QUE RECIBIRA LAS PETICIONES AJAX Y HARA LA SINCRONIA
 *
 * */


//importando el archivo de controller
require_once "../../controllers/controller.php";
//importando las funcion de BD
require_once "../../models/crud.php";;


class Ajax
{
    //varaible publicas
    public $validarUsuario;
    public $validarEmail;

    public function validarUsuarioAjax()
    {
        //guardamos en una variable lo que esta en la variable publica por cada instancia
        $datos = $this->validarUsuario;

        //en otra variable llamamos auna funcion del controller
        //que recibira por parametro los datos
        $respuesta = @MvcController::validarUsuarioController($datos);

        echo $respuesta;
    }

    public function validarEmailAjax()
    {
        //guardamos en una variable lo que esta en la variable publica por cada instancia
        $datos = $this->validarEmail;

        //en otra variable llamamos auna funcion del controller
        //que recibira por parametro los datos
        $respuesta = @MvcController::validarEmailController($datos);

        echo $respuesta;
    }


}

//validamos que se halalla enviado por post esa varaible
//de lo contrario no se ejecutara
if (isset($_POST['validarUsuario'])) {

//creamos un objeto de la clase
    $a = new Ajax();
//le asginamos valor a la variabley le pasemos lo que apse
//por POST el archivo AJAX
    $a->validarUsuario = $_POST['validarUsuario'];
//ejecutmaos la funcion de la clase Ajax
    $a->validarUsuarioAjax();
}


if(isset($_POST['validarEmail'])){
    $b = new Ajax();
    $b->validarEmail = $_POST['validarEmail'];
    $b->validarEmailAjax();
}


?>