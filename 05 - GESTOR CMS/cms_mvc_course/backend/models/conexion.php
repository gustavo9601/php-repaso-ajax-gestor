<?php

#CLASE DE CONEXION
class Conexion
{


    public function conectar()
    {


        try{

            $conexion = NEW PDO(
                'mysql:host=localhost;dbname=cms',
                'root',
                ''
            );

            return $conexion;

        }catch (PDOException $e){
            return false;
        }
    }


}


/*$nuevo = NEW Conexion();
$nuevo ->conectar();*/


?>