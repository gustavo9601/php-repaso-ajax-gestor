<?php

require_once 'conexion.php';

class GestorContactoModel
{
    public function todosLosSuscriptoresModel($tabla)
    {
        $connec = @Conexion::conectar();
        $sql = "SELECT * FROM $tabla WHERE estado = true";
        $statement = $connec->prepare($sql);
        $statement->execute();
        $respuesta = $statement->fetchAll();
        return $respuesta;
        $connec = '';
    }

    public function actualizarEstadoSuscriptorModel($datos, $tabla)
    {
        $connec = @Conexion::conectar();
        $sql = "UPDATE $tabla SET estado = false WHERE id = :id";
        $statement = $connec->prepare($sql);
        $statement->bindParam(':id', $datos, PDO::PARAM_INT);
        if ($statement->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $connec = '';
    }

}


?>