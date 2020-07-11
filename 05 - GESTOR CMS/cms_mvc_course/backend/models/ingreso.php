<?php
//importanos la conexion
require_once 'conexion.php';

//hacmos que extienda de conexion
class IngresoModels extends Conexion {

    public function ingresoModel($datosModel){

        //creamos la varaible, llamando la funcion de conexion


        $conexion = Conexion::conectar();

        //creamos el sql
        $sql = "SELECT * FROM usuarios 
                WHERE usuario = :usuario ";

        //preparamos la conexion y asiganmos al statement
        $statement = $conexion ->prepare($sql);
        //pasamos los parametros y especificamos que son texto
        $statement->bindParam(":usuario", $datosModel['usuario'], PDO::PARAM_STR);
        //ejecutamos el query
        $statement->execute();


        //retornamos lo que devuelva con fetch
        return $statement->fetch();

        //cerramos la conexion
        $conexion = "";
    }



    public function intentosModel($datosModel){
        //creamos la varaible, llamando la funcion de conexion


        $conexion = Conexion::conectar();

        //creamos el sql
        $sql = "UPDATE usuarios SET intentos = :intentos 
                WHERE usuario = :usuario";

        //preparamos la conexion y asiganmos al statement
        $statement = $conexion ->prepare($sql);
        //pasamos los parametros y especificamos que son texto
        $statement->bindParam(":usuario", $datosModel['usuario'], PDO::PARAM_STR);
        $statement->bindParam(":intentos", $datosModel['intentos'], PDO::PARAM_INT);

        //ejecutamos el query
        $statement->execute();
        //cerramos la conexion
//        /$statement->close();
    }



}


?>