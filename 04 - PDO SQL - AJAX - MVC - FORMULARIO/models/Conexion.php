<?php

/*
  * Conexion por PDO
  * PDO -> POO
  * */


class Conexion
{

    public function conectar()
    {
        $var_conecct = NEW PDO(
            'mysql:host=localhost;dbname=basic_login',
            'root',
            ''
        );

        /*
        var_dump($var_conecct); 
*/
        return $var_conecct;
    }
}
/*
Ejemplo de llamado de la funcion de conectar
$llamado_Prueba = new Conexion();
$llamado_Prueba->conetar();*/

?>