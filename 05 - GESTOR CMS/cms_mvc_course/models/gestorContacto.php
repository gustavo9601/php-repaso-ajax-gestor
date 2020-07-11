<?php
require_once 'backend/models/conexion.php';


class ContactoModels
{


    #FUNCION DE INSERTAR EL SUSCRIPTOR
    public function insertandoContactoBD($datos, $tabla)
    {
        $conec = @Conexion::conectar();
        $sql = "INSERT INTO $tabla (nombre, password, email, estado) VALUES (:nombre, :password, :email, true)";
        $statement = $conec->prepare($sql);
        $statement->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
        $statement->bindParam(':password', $datos['password'], PDO::PARAM_STR);
        $statement->bindParam(':email', $datos['email'], PDO::PARAM_STR);
        if ($statement->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
        $conec = '';
    }


    #FUNCION DE INSERTAR EL MENSAJE
    public function insertandoComentarioBD($datos, $tabla)
    {
        $conec = @Conexion::conectar();
        $sql = "INSERT INTO $tabla (nombre, email,comentario, estado) VALUES (:nombre, :email,:comentario, false)";
        $statement = $conec->prepare($sql);
        $statement->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
        $statement->bindParam(':comentario', $datos['comentario'], PDO::PARAM_STR);
        $statement->bindParam(':email', $datos['email'], PDO::PARAM_STR);
        if ($statement->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
        $conec = '';
    }
}

?>