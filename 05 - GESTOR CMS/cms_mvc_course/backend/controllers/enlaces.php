<?php

/*
 * ARCHIVO -> QUE ENVIARA ORDEN AL MODELO, LA VARAIBLE GET URL -> VISTA CORREPONDIENTE
 * */

class Enlaces {

    public function enlacesController() {

        //validamos que se paso por parametro la variable, qu edevolver
        // que se pagina se debe cargar
        if (isset($_GET['action'])) {

            $enlaces = $_GET['action'];
        } else {
            //de lo contrario simpre redirecinamos al modelo
            $enlaces = "index";
        }


        //gurdarmos en una variable, la invocaion de la funcion de la clase EnalcesModels
        $respuesta = @EnlacesModels::enlacesModel($enlaces);

        //de acuerd a lo que ns devuelva respuesta -> incluimos el archivo a visualizar
        include_once $respuesta;
    }

}

?>