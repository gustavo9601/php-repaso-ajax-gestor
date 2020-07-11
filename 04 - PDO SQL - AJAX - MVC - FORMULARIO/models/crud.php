<?php

#EXTENCION DE CLASES:
//Los objetos pueden ser extendidos y pueden heredar propiedades y metodoes de su padre

/*
 * Archivo encargado de ejecutrar todas las ffunciones a la bd
 *y exteiende de la clase Conexion
 *
 * */
//archivo que trae la conexion
require_once 'conexion.php';


class Datos extends Conexion
{
    #FUNCIONREGISTRO DE USUARIOS
    public function registroUsuarioModel($datosModel, $tabla)
    {



        //vaarbiel que alamcena lo que reotran la funcion conectar, de la clase Conexion
        $ifConexion = Conexion::conectar();

        //SQL
        $sql = 'INSERT INTO usuarios (usuario, password , email, intentos) VALUES ( :usuario, :password, :email , 0) ';
        //prepracion de conexion, recibe como una consukta
        $statement = $ifConexion->prepare($sql);
        //con bindParam, enalzamos los datos a enviar, ejecituamos
        $statement->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
        $statement->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
        $statement->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);

        //ejecutamos el query
        //este valor arroja un valor booleano
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }

        //le decimo sque retorne algo, para que el controlador resiba ese reotrno y sea lo que
        //se muestre al usuario en la vista

        $statement->close(); //cerramos la conexion
    }


#FUNCION INGRESO DE USUARIOS
    public function ingresoUsuarioModel($datosModel, $tabla)
    {
        //invocando la funcion conectar, de la clase Conectar
        $ifConexion = Conexion::conectar();

        //sql
        $sql = "SELECT usuario, password, intentos FROM usuarios 
          WHERE usuario = :usuario ";

        //preparando el sql dentro de una varaible statement, que resice por paraemtro el query
        $statement = $ifConexion->prepare($sql);

        //recibiendo los parametros saneticzados
        $statement->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);


        //ejecutando el query
        $statement->execute();

        //guardando en una varaible el resutlado, fetch retorna una fila de la consulta en forma de Array
        $resultado = $statement->fetch();

        //retornamos lo que devyelva la consultas
        return $resultado;

        $statement->close(); //cerramos la conexion

    }


    #FUNCION DE INTENTO DE INGRESO DE SUSUARIOS, QUE ACTUALIZARA LA BD
    public function intentosUsuarioModel($datosModel, $tabla){
        //invocando la funcion conectar, de la clase Conectar
        $ifConexion = Conexion::conectar();

        //sql
        $sql = "UPDATE usuarios SET intentos = :intentos 
                WHERE usuario = :usuario";

        //preparara en una varaible
        $statement = $ifConexion->prepare($sql);

        //pasamos los parametros, desde el array $datos que recibiimos como parameto
        $statement->bindParam(":intentos", $datosModel['actualizarIntentos'], PDO::PARAM_STR);
        $statement->bindParam(":usuario", $datosModel['usuarioActual'], PDO::PARAM_STR);

        //ejcutando el query
        if ($statement->execute()){
            return true;
        }else{
            return false;
        }


    }



   #FUNCION QUE TRAERA A TODOS LO SUSUARIOS DE LA BD

    public function vistaUsuarioModel(){
        //invocando la funcion conectar, de la clase Conectar
        $ifConexion = Conexion::conectar();

        //sql
        $sql = "SELECT * FROM usuarios";

        //preparando el sql dentro de una varaible statement, que resice por paraemtro el query
        $statement = $ifConexion->prepare($sql);

        //ejecutamos la la consulta
        $statement->execute();

        //alamcenando los reusltados con fetcall en forma de Array
        $resutlado = $statement->fetchAll();

        //retornamos el resultado

        return $resutlado;

        $statement->close(); //cerramos la conexion

    }


    #FUNCION DE EDITAR USUARIO, QUE DEVOLERA LA INFORMACION COMO FILTRO EL ID
    public function editarUsuarioModel($id){

        //invocando la funcion conectar, de la clase Conectar
        $ifConexion = Conexion::conectar();

        //sql
        $sql = "SELECT * FROM usuarios WHERE id = :id";

        //preparara en una varaible
        $statement = $ifConexion->prepare($sql);

        //pasamos los parametros
        $statement->bindParam(":id", $id, PDO::PARAM_INT);

        //ejcutando el query
        $statement->execute();

        //retornamos una sola fila que es la informacion idicivudual del usuario
        $resultado = $statement->fetch();

        //retornamos resultado
        return $resultado;

        $statement->close();
    }


    #FUNCION QUE ACTUALIZARA LOS DATOS MODIFICADOS EN EL FORMULARIO
    public function actualizarUsuarioModel($datos){
        //invocando la funcion conectar, de la clase Conectar
        $ifConexion = Conexion::conectar();

        //sql
        $sql = "UPDATE usuarios SET usuario = :usuario, password = :password, email = :email 
                WHERE id = :id";

        //preparara en una varaible
        $statement = $ifConexion->prepare($sql);

        //pasamos los parametros, desde el array $datos que recibiimos como parameto
        $statement->bindParam(":id", $datos['id'], PDO::PARAM_INT);
        $statement->bindParam(":password", $datos['password'], PDO::PARAM_STR);
        $statement->bindParam(":email", $datos['email'], PDO::PARAM_STR);
        $statement->bindParam(":usuario", $datos['usuario'], PDO::PARAM_STR);

        //ejcutando el query
        $statement->execute();

        //este valor arroja un valor booleano, Y VALIDAMOS SI SE EFECTUO o no el update
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }

        $statement->close();
    }



    #FUNCION QUE ELIMINARA EL REGISTRO POR FILTRO ID
    public function borrarUsuarioModel($idBorrar){
        //invocando la funcion conectar, de la clase Conectar
        $ifConexion = Conexion::conectar();

        //sql
        $sql = "DELETE FROM usuarios WHERE id = :id";

        //preparara en una varaible
        $statement = $ifConexion->prepare($sql);

        //pasamos los parametros, desde el array $datos que recibiimos como parameto
        $statement->bindParam(":id", $idBorrar, PDO::PARAM_INT);

        //ejcutando el query
        $statement->execute();

        //este valor arroja un valor booleano, Y VALIDAMOS SI SE EFECTUO o no la eliminacion
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }

        $statement->close();
    }


    #FUNCION QUE DEVOLVERA SI EXISTE YA EL USUARIOs
    public function validarUsuarioModel($datosModel){
        //invocando la funcion conectar, de la clase Conectar
        $ifConexion = Conexion::conectar();

        //sql
        $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";

        //preparara en una varaible
        $statement = $ifConexion->prepare($sql);

        //pasamos los parametros, desde el array $datos que recibiimos como parameto
        $statement->bindParam(":usuario", $datosModel, PDO::PARAM_INT);

        //ejcutando el query
        $statement->execute();

        //retornamos lo que devuelve de encontrar conicidencias
        return $statement->fetch();

        $statement->close();
    }

    #FUNCION QUE DEVOLVERA SI EXISTE YA EL EMAIL
    public function validarEmailModel ($datosModel){
        //invocando la funcion conectar, de la clase Conectar
        $ifConexion = Conexion::conectar();

        //sql
        $sql = "SELECT * FROM usuarios WHERE email = :email";

        //preparara en una varaible
        $statement = $ifConexion->prepare($sql);

        //pasamos los parametros, desde el array $datos que recibiimos como parameto
        $statement->bindParam(":email", $datosModel, PDO::PARAM_INT);

        //ejcutando el query
        $statement->execute();

        //retornamos lo que devuelve de encontrar conicidencias
        return $statement->fetch();

        $statement->close();
    }



}

?>