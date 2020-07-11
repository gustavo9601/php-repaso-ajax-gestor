<?php

class EnlacesModels
{
    #FUNCION QUE RECIBE EL PARAMETRO, ARCHIVO A CARGAR //LISTA BLANCA

    public function enlacesModel($enlaces)
    {
        if ($enlaces == "inicio" ||
            $enlaces == "ingreso" ||
            $enlaces == "slide" ||
            $enlaces == "articulos" ||
            $enlaces == "galeria" ||
            $enlaces == "videos" ||
            $enlaces == "suscriptores" ||
            $enlaces == "mensajes" ||
            $enlaces == "perfil" ||
            $enlaces == "salir" ||
            $enlaces == 'reporteExcel' ||
            $enlaces == 'reporteWord'
        ) {
            //creamos la ruta del directorio archivo a cargar
            $module = "views/modules/" . $enlaces . ".php";
        } else if ($enlaces == "index") {
            //cargara el ingreo php
            $module = "views/modules/ingreso.php";
        } else {
            //cargara el ingreo php
            $module = "views/modules/ingreso.php";
        }

        //retornamos la variable, module que conteiene la ruta del directoro a caragar
        return $module;
    }

}

?>