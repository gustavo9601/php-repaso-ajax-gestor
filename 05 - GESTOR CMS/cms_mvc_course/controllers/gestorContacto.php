<?php

class ContactoController
{

    public $nombre;
    public $email;
    public $comentario;

    public function enviaComentarioController()
    {
        $datos = [
            'nombre' => $this->nombre,
            'email' => $this->email,
            'comentario' => $this->comentario,
            'password' => 'Pruebas1234*'
        ];

        //llamando al modelo


        $respuesta1 = @ContactoModel::insertandoContactoBD($datos, 'suscriptores');
        $respuesta2 = @ContactoModel::insertandoComentarioBD($datos, 'mensajes');
        if ($respuesta1 == 'ok') {
            echo 'ok';
        } else {
            echo 'error en contaco';
        }

        if ($respuesta2 == 'ok') {
            echo 'ok';
        } else {
            echo 'error en comentario';
        }

    }



    /*FUNCION DEL MODELO*/
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


class ContactoModel
{
    #FUNCION DE INSERTAR EL SUSCRIPTOR
    public function insertandoContactoBD($datos, $tabla)
    {
        $conec = @Conexiones::conectar();
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
        $conec = @Conexiones::conectar();
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


#CLASE DE CONEXION
class Conexiones
{


    public function conectar()
    {


        try {

            $conexion = NEW PDO(
                'mysql:host=localhost;dbname=cms',
                'root',
                ''
            );

            return $conexion;

        } catch (PDOException $e) {
            return false;
        }
    }


}

/*validando si recibe la peticion*/

if (isset($_POST['comentario'])) {
    $a = NEW ContactoController();
    $a->nombre = $_POST['nombre'];
    $a->email = $_POST['email'];
    $a->comentario = $_POST['comentario'];
    $a->enviaComentarioController();

}

?>