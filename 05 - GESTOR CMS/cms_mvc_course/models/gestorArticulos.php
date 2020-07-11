<?php
require_once 'backend/models/conexion.php';
class ArticulosModel
{
    public function MostrarArticulosFronted()
    {
        //conexion con la bd
        $conexion = Conexion::conectar();

        //sql
        $sql = "SELECT * FROM articulos ORDER BY orden";

        //preparamos la cunsulta
        $statement = $conexion->prepare($sql);

        //ejecutamos la consulta
        $statement-> execute();

        //guardamos en una varaible la consulta
        $resultado = $statement->fetchAll();

        //retornamos la consulta
        return $resultado;

        //cerramos conexion
        $conexion = '';
    }
}

?>