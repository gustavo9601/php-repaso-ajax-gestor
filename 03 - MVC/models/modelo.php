<?php


class EnlacesPaginas
{

    public function enlacesPaginasModelo($enlacesModel)
    {
//validamos que sea alguno valido para traer la informacion correcta
        if ($enlacesModel == 'nosotros' || $enlacesModel == 'servicios'
            || $enlacesModel == 'contactenos'
        ) {

            //creamos una cariable de ruta para de acuerdo a lo que
            //se pase po rparaemtro se redirjia al archivo
            $module = "views/modules/{$enlacesModel}.php";
        }else if($enlacesModel == "index"){
            $module = "views/modules/inicio.php";
        }else{
            //si llega hasta el no siginifica que se apso un paraemtro invalido
            // igual fomra le dico se redirijia a inicio
            $module = "views/modules/inicio.php";
        }

        //retornamos la url
        return $module;
    }


}

?>