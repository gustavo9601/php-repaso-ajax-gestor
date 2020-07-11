<?php

require_once 'conexion.php';

class MensajeModel
{
    #FUNCION QUE DEVUELVE LOS DATOS DE LOS MENSAJES NO VISTOS
    public function mostrarMensajesSinVerModel($tabla)
    {
        $conec = @Conexion::conectar();
        $sql = "SELECT * FROM $tabla WHERE estado = false";
        $statement = $conec->prepare($sql);
        $statement->execute();
        $respuesta = $statement->fetchAll();
        return $respuesta;
        $conec = '';
    }

    #FUNCION QUE ACTUALIZA EL ESTADO DEL MESANJE VISTO
    public function actualizaEstadoMensajeModel($datos)
    {
        $conec = @Conexion::conectar();
        $sql = "UPDATE mensajes SET estado = true WHERE id = :id";
        $statement = $conec->prepare($sql);
        $statement->bindParam(':id', $datos, PDO::PARAM_INT);
        if ($statement->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
        $conec = '';
    }

    #FUNCION QUE DEVUELVE LOS MENSAJES SEGUN EL ESTADO VITO O NO
    public function mostrarMensajeModel($datos)
    {
        $conec = @Conexion::conectar();
        $sql = "SELECT * FROM mensajes WHERE estado = :estado";
        $statement = $conec->prepare($sql);
        $statement->bindParam(':estado', $datos, PDO::PARAM_STR);
        $statement->execute();
        $respuesta = $statement->fetchAll();
        return $respuesta;
        $conec = '';
    }

    #FUNCION QUE DEVUELVE LOS EMAILS DE LOS USCRITRES
    public function devuelveEmailsMensajeModel()
    {
        $conec = @Conexion::conectar();
        $sql = "SELECT * FROM mensajes ORDER BY nombre";
        $statement = $conec->prepare($sql);
        $statement->execute();
        $respuesta = $statement->fetchAll();
        return $respuesta;
        $conec = '';
    }

    #FUNCION QUE DEVUELVE LA CANTIDAD DE MENSAJES SIN LEER
    public function cantidadMensajesSinLeerModel(){
        $conec = @Conexion::conectar();
        $sql = "SELECT count(*) AS CANTIDAD from mensajes WHERE estado = false";
        $statement = $conec->prepare($sql);
        $statement->execute();
        $respuesta = $statement->fetch();
        return $respuesta;
        $conec = '';
    }


}

?>