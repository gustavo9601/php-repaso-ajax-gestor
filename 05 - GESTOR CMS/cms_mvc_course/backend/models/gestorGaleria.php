<?php
require_once 'conexion.php';


class GestorGaleriaModel
{
    #FUNCION QUE INSERTARA LOS DATOS DE LA IAMGEN DE GALERIA A LA BD
    public function subirImagenGaleriaModel($ruta, $tabla)
    {
        //conexion
        $conect = @Conexion::conectar();

        //sql
        $sql = "INSERT INTO $tabla (ruta, orden) VALUES (:ruta, 0)";

        //preparacion
        $statement = $conect->prepare($sql);
        //enlace
        $statement->bindParam(':ruta', $ruta, PDO::PARAM_STR);
        //ejecucion
        if ($statement->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $conect = '';

    }


    #FUNCION QUE DEVUELVE LAS RUTAS DE LAS IMAGENES
    public function mostrarImagenGaleriaModel($ruta, $tabla)
    {
        //conexion
        $conect = @Conexion::conectar();

        //sql
        $sql = "SELECT ruta FROM $tabla WHERE ruta = :ruta";

        //preparacion
        $statement = $conect->prepare($sql);
        //enlace
        $statement->bindParam(':ruta', $ruta, PDO::PARAM_STR);
        //ejecucion
        $statement->execute();

        //alamcaeno el reusltado
        $resultado = $statement->fetch();

        return $resultado;

        $conect = '';
    }

    #FUNCION QUE DEVUELVE TODAS LAS RUTAS DE IMAGENES
    public function muestraTodasLasImagenesGaleria($tabla)
    {
        //conexion
        $conect = @Conexion::conectar();

        //sql
        $sql = "SELECT id, ruta FROM $tabla ORDER BY orden";

        //preparacion
        $statement = $conect->prepare($sql);
        //ejecucion
        $statement->execute();

        //alamcaeno el reusltado
        $resultado = $statement->fetchAll();
        return $resultado;
        $conect = '';
    }


    #FUNCION DE ELIMINAR EL ITEM POR ID;
    public function eliminarGaleriaModel($datos, $tabla)
    {
        //conexion
        $conect = @Conexion::conectar();

        //sql
        $sql = "DELETE FROM $tabla WHERE id = :id";
        //preparacion
        $statement = $conect->prepare($sql);
        //enalce de parametros
        $statement->bindParam(':id', $datos['idGaleria'], PDO::PARAM_INT);
        //ejecucion
        if ($statement->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
        $conect = '';
    }


    #FUNCION QUE ACTIALIZARA EL ORDEN LAS IMAGENES
    public function actualizarOrdenModel($datos, $tabla)
    {
//conexion
        $conect = @Conexion::conectar();

        //sql
        $sql = "UPDATE $tabla SET orden = :orden WHERE id = :id ";
        //preparacion
        $statement = $conect->prepare($sql);
        //enalce de parametros


        $statement->bindParam(':orden', $datos['ordenItem'], PDO::PARAM_INT);
        $statement->bindParam(':id', $datos['ordenGaleria'], PDO::PARAM_INT);
        //ejecucion
        if ($statement->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
        $conect = '';
    }


    #FUNCION QUE DEVUELVE LOS REGISTROS ORDENADOS POR ORDEN
    public function seleccionarOrdenModel($tabla)
    {
//conexion
        $conect = @Conexion::conectar();

        //sql
        $sql = "SELECT id, ruta FROM $tabla ORDER BY orden ASC";
        //preparacion
        $statement = $conect->prepare($sql);
        //ejecucion
        $statement->execute();
        //alamacenando los resultado
        $resultado = $statement->fetchAll();
        return $resultado;
        $conect = '';
    }


}


?>