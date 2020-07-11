<?php

require_once 'backend/models/conexion.php';

class VidesoModel
{


    public function seleccionarVideosModel($tabla)
    {
        $connect = @Conexion::conectar();
        $sql = "SELECT id, ruta FROM $tabla ORDER BY orden ASC";
        $statement = $connect->prepare($sql);
        $statement->execute();
        $respuesta = $statement->fetchAll();
        return $respuesta;
        $connect = '';
    }

}

?>