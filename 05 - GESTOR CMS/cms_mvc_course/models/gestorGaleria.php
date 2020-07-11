<?php
require_once 'backend/models/conexion.php';

class GaleriaModels
{
    public function seleccionarGaleriaModel($tabla)
    {
        $conection = @Conexion::conectar();

        $sql = "SELECT ruta FROM $tabla ORDER BY orden ASC ";

        $statement = $conection->prepare($sql);

        $statement->execute();

        $respuesta = $statement->fetchAll();

        return $respuesta;

        $conection = '';
    }
}

?>