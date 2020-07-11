<?php
//importando la conexion a la BD
require_once 'conexion.php';

class GestorSlideModel
{
    #FUNCION QUE SUBE LA RITA DE LA IAMGEN A LA BD
    public function subirImagenSlideModel($ruta, $tabla)
    {

        //conexion con la bd
        $conexion = Conexion::conectar();

        //sql
        $sql = "INSERT INTO slide ( ruta, titulo, descripcion) VALUES ( :ruta, '', '')";

        //preparamos la consulta
        $statement = $conexion->prepare($sql);

        //añadimos los parametros con bind
        $statement->bindParam(":ruta", $ruta, PDO::PARAM_STR);

        //ejecutamos y validamos
        if ($statement->execute()) {
            return 'ok';
        } else {
            return "error";
        }

        $conexion->close();
    }


    //function que devolvera con un select la imagen a cargar
    public function mostrarImagenSlideModel($ruta, $tabla)
    {
        //conexion con la bd
        $conexion = Conexion::conectar();

        //sql
        $sql = "SELECT ruta FROM slide WHERE ruta = :ruta";

        //preparamos la cunsulta
        $statement = $conexion->prepare($sql);

        //enlzamos
        $statement->bindParam(':ruta', $ruta, PDO::PARAM_STR);

        //ejecutamos la cosulta
        $statement->execute();

        //guardamos el resultado
        $resultado = $statement->fetch();

        return $resultado;

        //cerramos conexion
        $conexion->close();


    }


    #MOSTRAR IMAGEN EN LA VISTA CON UN SELECT
    public function mostrarImagenVistaModel($tabla)
    {
        //conexion con la bd
        $conexion = Conexion::conectar();

        //sql
        $sql = "SELECT * FROM $tabla ORDER BY orden ASC";

        //preparamos la cunsulta
        $statement = $conexion->prepare($sql);

        //ejecutamos la cosulta
        $statement->execute();

        //guardamos el resultado
        $resultado = $statement->fetchAll();

        return $resultado;

        //cerramos conexion
        $conexion->close();
    }

    #FUNCION DE ELIMINAR ITEM DEL SLIDE
    public function eliminarSlideModel($datos, $tabla)
    {
        //conexion con la bd
        $conexion = Conexion::conectar();

        //sql
        $sql = "DELETE FROM $tabla WHERE id = :id";

        //preparamos la cunsulta
        $statement = $conexion->prepare($sql);
        //enlazamos parametros
        $statement->bindParam(':id', $datos['idSlide'], PDO::PARAM_STR);
        //ejecutamos la cosulta
        if ($statement->execute()) {
            return "ok";
        } else {
            return "error";
        }

        //cerramos conexion
        $conexion->close();
    }


    #FUNCION DE ACTUALIZAR EL SLIDE
    public function actualizarSlideModel($datos, $tabla)
    {
//conexion con la bd
        $conexion = Conexion::conectar();

        //sql
        $sql = "UPDATE $tabla SET titulo = :titulo, descripcion = :descripcion WHERE id = :id";

        //preparamos la cunsulta
        $statement = $conexion->prepare($sql);
        //enlazamos parametros
        $statement->bindParam(':titulo', $datos['enviarTitulo'], PDO::PARAM_STR);
        $statement->bindParam(':descripcion', $datos['enviarDescripcion'], PDO::PARAM_STR);
        $statement->bindParam(':id', $datos['enviarId'], PDO::PARAM_INT);
        //ejecutamos la cosulta
        if ($statement->execute()) {
            return "ok";
        } else {
            return "error";
        }

        //cerramos conexion
        $conexion->close();
    }

    #FUNCION QUE DEVOLVERA EL QUERY CUANDO SE HALLA ACTUALIZADO LA INFORMACION
    public function seleccionarActualizacionSlideModel($datos, $tabla)
    {
        //conexion con la bd
        $conexion = Conexion::conectar();

        //sql
        $sql = "SELECT * FROM $tabla WHERE id = :id";

        //preparamos la cunsulta
        $statement = $conexion->prepare($sql);

        //enlazamos la cunsulta
        $statement->bindParam(':id', $datos['enviarId'], PDO::PARAM_INT);
        //ejecutamos la cosulta
        $statement->execute();

        //guardamos el resultado
        $resultado = $statement->fetch();

        return $resultado;

        //cerramos conexion
        $conexion->close();
    }

    #FUNCION QUE ACTIALZIARA UNO A UNO EL ORDEN POR ID
    public function actualizarOrdenModel($datos, $tabla)
    {
        //conexion con la bd
        $conexion = Conexion::conectar();

        //sql
        $sql = "UPDATE $tabla SET orden = :orden WHERE id = :id";

        //preparamos la cunsulta
        $statement = $conexion->prepare($sql);

        //enlazamos la cunsulta
        $statement->bindParam(':orden', $datos['ordenItem'], PDO::PARAM_INT);
        $statement->bindParam(':id', $datos['ordenSlide'], PDO::PARAM_INT);


        //ejecutamos la cosulta y validamos si se ejecuto o no
        if ($statement->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        //cerramos conexion
        $conexion->close();
    }


    public function mostrarSlideTerminadoModel($tabla)
    {
        //conexion con la bd
        $conexion = Conexion::conectar();

        //sql
        $sql = "SELECT * FROM $tabla ORDER BY orden";

        //preparamos la cunsulta
        $statement = $conexion->prepare($sql);

        //ejecutando la consulta
        $statement->execute();
        //guardando la inffomacion a retornar
        $resultado = $statement->fetchAll();

        //retornamos la consulta
        return $resultado;
        //cerramos conexion
        $conexion->close();
    }

}

?>

