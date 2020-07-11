<?php

class MvcController
{

    //funcion del controlador que importa el archivo de template
    public function plantilla()
    {
        include_once 'views/template.php';
    }

    //BLQOUE INTACION CON EL USUARIO
    public function enlacesPaginasController()
    {

        //con isset validamos que tenga contenido la varaible
        if (isset($_GET['action'])) { //validamos que se halla pasado

            //guardon en una variable lo que pase po rget a la variable action
            $enlacesController = $_GET['action'];
        } else {

            $enlacesController = 'index';
        }

        //de esta forma invocamo sla clase EnlacesPaginas
        // y accedemos a la funcion enalgespaginasModelo();
        // con el @ quitamos la aletta
        @$respuesta = EnlacesPaginas::enlacesPaginasModelo($enlacesController);
        //Esa funcion de MODELO, retorna la ruta y nombre del archivo al cual se debe incliu

        // de acuerdo alo que nos pase el modelo generamos el requiere o include del archivp
        include_once $respuesta;


    }

}

?>