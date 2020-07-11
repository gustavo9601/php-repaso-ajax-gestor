<?php

class Paginas
{

    public function enlacesPaginasModel($enlaces)
    {


        if ($enlaces == "ingresar" || $enlaces == "usuarios" || $enlaces == "editar" || $enlaces == "salir") {

            $module = "views/modules/" . $enlaces . ".php";

        } else if ($enlaces == "index") {

            $module = "views/modules/registro.php";

        } else if ($enlaces == "ok") { //si se efecto OK el registro en la BD
            $module = "views/modules/registro.php";
        }else if ($enlaces == "fallo") { //si lo que se pase por GET  es fallo reidirjia al index/ingresar de resitro pasando lo mismo po rget
            $module = "views/modules/ingresar.php";
        }else if ($enlaces == "falloIntentos") { //si lo que se pase por GET  es falloIntentso reidirjia al index/ingresar de resitro pasando lo mismo po rget
            $module = "views/modules/ingresar.php";
        }        else if ($enlaces == "cambio") { // si se pasa cambio en el GET, es por se efecuto el UPDATE y se redireccionara a usuarios
            $module = "views/modules/usuarios.php";
        }else {
            $module = "views/modules/registro.php";

        }

        return $module;

    }

}

?>