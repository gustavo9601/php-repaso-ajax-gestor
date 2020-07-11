<?php

require_once 'conexion.php';

class SuscriptoresModel
{
    public function impresionSuscriptoresModel($tabla)
    {
        $connect = @Conexion::conectar();
        $sql = "SELECT nombre, email FROM $tabla";
        $stament = $connect->prepare($sql);
        $stament->execute();
        $resultado = $stament->fetchAll();
        return $resultado;
        $stament = "";
    }
}

?>