<?php

//importando la conexion a la BD
require_once 'backend/models/conexion.php';

class SlideModels
{

    public function seleccionarSlideModel($tabla)
    {
        //conexion con la bd
        $conexion = Conexion::conectar();

        //sql
        $sql = "SELECT * FROM slide ORDER BY orden";

        //preparamos la cunsulta
        $statement = $conexion->prepare($sql);

        //ejecutamos la consulta
        $statement-> execute();

        //guardamos en una varaible la consulta
        $resultado = $statement->fetchAll();

        //retornamos la consulta
        return $resultado;

        //cerramos conexion
        $conexion->close();
    }


}

?>