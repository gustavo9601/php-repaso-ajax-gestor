<?php

require_once 'conexion.php';

class GestorVideosModel
{
    public function subirVideoModel($ruta, $tabla)
    {
        $connect = @Conexion::conectar();
        $sql = "INSERT INTO $tabla (ruta, orden) VALUES (:ruta,0)";
        $statement = $connect->prepare($sql);
        $statement->bindParam(':ruta', $ruta, PDO::PARAM_STR);
        if ($statement->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
        $connect = '';
    }


    public function mostrarVideoModel($ruta, $tabla)
    {
        $connect = @Conexion::conectar();
        $sql = "SELECT ruta FROM videos WHERE ruta = :ruta";
        $statement = $connect->prepare($sql);
        $statement->bindParam(':ruta', $ruta, PDO::PARAM_STR);
        $statement->execute();
        $respuesta = $statement->fetch();
        return $respuesta;
        $connect = '';
    }

    #FUNCION QUE DEVUELVE TODAS LAS RUTAS DE LOS VIDEOS
    public function mostrarVideoVistaModel($tabla)
    {
        $connect = @Conexion::conectar();
        $sql = "SELECT id, ruta FROM $tabla ORDER BY orden ASC";
        $statement = $connect->prepare($sql);
        $statement->execute();
        $respuesta = $statement->fetchAll();
        return $respuesta;
        $connect = '';
    }


    public function eliminarVideoModel($datos, $tabla)
    {
        $connect = @Conexion::conectar();
        $sql = "DELETE FROM $tabla WHERE id = :id";
        $statement = $connect->prepare($sql);
        $statement->bindParam(':id', $datos['idVideo'], PDO::PARAM_INT);
        if ($statement->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
        $connect = '';

    }


    #FUNCION DE ACTUALIZAR ORDEN
    public function actualizarOrdenModel($datos, $tabla)
    {
        $connect = @Conexion::conectar();
        $sql = "UPDATE $tabla SET orden = :orden WHERE id = :id";
        $statement = $connect->prepare($sql);

    /*    echo 'ID = ' . $datos['ordenVideo'];
        echo ' ORDEN = '.$datos['ordenItem'];*/

        $statement->bindParam(':id', $datos['ordenVideo'], PDO::PARAM_INT);
        $statement->bindParam(':orden', $datos['ordenItem'], PDO::PARAM_INT);
        if ($statement->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
        $connect = '';
    }

    public function seleccionarOrdenModel($tabla)
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