<?php

//importamos la conexion
require_once 'conexion.php';

class GestorArticulosModel
{

    #FUNCION DE INSERSION EN LA BD / CREACION ARTICULO
    public function guardarArticuloModel($datos, $tabla)
    {
        //conexion con la bd
        $conexion = @Conexion::conectar();

        //sql
        $sql = "INSERT INTO $tabla (titulo, introduccion, ruta, contenido) VALUES (:titulo, :introduccion, :ruta, :contenido)";

        //preparamos la cunsulta
        $statement = $conexion->prepare($sql);

        //enlazamos las variables
        $statement->bindParam(':titulo', $datos['titulo'], PDO::PARAM_STR);
        $statement->bindParam(':introduccion', $datos['introduccion'], PDO::PARAM_STR);
        $statement->bindParam(':ruta', $datos['ruta'], PDO::PARAM_STR);
        $statement->bindParam(':contenido', $datos['contenido'], PDO::PARAM_STR);


        //ejecutando la consulta
        if ($statement->execute()) {
            //devolvemos true si se ejecuto
            return true;
        } else {
            return 'no se pudo insertar';
        }

    }

    #FUNCION QUE DEVOLVERA EL QUERY CON TODOS LOS ARTIUCLOS
    public function mostrarArticulosModel($tabla)
    {
        //conexion con la bd
        $conexion = @Conexion::conectar();
        //sql
        $sql = "SELECT id, titulo, introduccion, ruta, contenido FROM $tabla ORDER BY orden ASC";
        //preparamos la cunsulta
        $statement = $conexion->prepare($sql);
        //ejecutando la consulta
        $statement->execute();
        //gurdando resultados:
        $resultado = $statement->fetchAll();

        return $resultado;

        $conexion = "";  //hacemos null la conexion
    }


    #FUNCION QIE ELIMINARA EL ARTIUCLO
    public function borrarArticuloModel($datosModel, $tabla)
    {
        //conexion con la bd
        $conexion = @Conexion::conectar();
        //sql
        $sql = "DELETE FROM $tabla WHERE id = :id";
        //preparamos la cunsulta
        $statement = $conexion->prepare($sql);
        //añadiendo los parametros, enalzando
        $statement->bindParam(":id", $datosModel, PDO::PARAM_INT);
        //ejecutando la consulta

        if ($statement->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $conexion = "";  //hacemos null la conexion
    }


    #FUNCION DE ACTUALIZAR EL ARTICULO
    public function editarArticuloModel($datosModel, $tabla)
    {
        //conexion con la bd
        $conexion = @Conexion::conectar();
        //sql
        $sql = "UPDATE $tabla SET titulo = :titulo, introduccion = :introduccion ,ruta = :ruta,  contenido = :contenido WHERE id = :id";
        //preparamos la cunsulta
        $statement = $conexion->prepare($sql);
        //añadiendo los parametros, enalzando
        $statement->bindParam(":id", $datosModel['id'], PDO::PARAM_INT);
        $statement->bindParam(":introduccion", $datosModel['introduccion'], PDO::PARAM_STR);
        $statement->bindParam(":ruta", $datosModel['ruta'], PDO::PARAM_STR);
        $statement->bindParam(":contenido", $datosModel['contenido'], PDO::PARAM_STR);
        $statement->bindParam(":titulo", $datosModel['titulo'], PDO::PARAM_STR);
        //ejecutando la consulta

        if ($statement->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $conexion = "";  //hacemos null la conexion
    }


    #FUNCION DE ACTUALIZAR MODELO
    public function actualizarOrdenoModel($datos)
    {
        //conexion con la bd
        $conexion = @Conexion::conectar();
        //sql
        $sql = "UPDATE articulos SET orden = :orden WHERE id = :id";
        //preparamos la cunsulta
        $statement = $conexion->prepare($sql);
        //añadiendo los parametros, enalzando

        /*
                echo '<pre>';
                print_r($datos);*/

        $statement->bindParam(":orden", $datos['ordenArticulos'], PDO::PARAM_INT);
        $statement->bindParam(":id", $datos['ordenItem'], PDO::PARAM_INT);
        //ejecutando la consulta

        if ($statement->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $conexion = "";  //hacemos null la conexion
    }


    #FUNCION QUE DEVUELVE LOS ITEM LI, ORDENADOS POR LA POSICION
    public function seleccionarOrdenoModel($tabla)
    {
        $conexion = @Conexion::conectar();
        //sql
        $sql = "SELECT * FROM $tabla ORDER BY orden";
        //preparamos la cunsulta
        $statement = $conexion->prepare($sql);
        //ejecutando la consulta
        $statement->execute();

        //guardo los datos devueltos
        $respuesta = $statement->fetchAll();

        return $respuesta;

        $conexion = "";  //hacemos null la conexion
    }

}


?>
