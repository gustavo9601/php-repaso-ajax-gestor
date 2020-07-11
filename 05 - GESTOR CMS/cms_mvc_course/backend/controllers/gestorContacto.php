<?php

class GestorContactoConroller
{
    public function todosLosSuscriptoresController()
    {
        $respuesta = @GestorContactoModel::todosLosSuscriptoresModel('suscriptores');

        foreach ($respuesta as $dato) {
            echo '<tr id="' . $dato['id'] . '" nombre="' . $dato['nombre'] . '">
                <td>' . $dato['nombre'] . '</td>
                <td>' . $dato['password'] . '</td>
                <td>' . $dato['email'] . '</td>
                <td><span class="btn btn-danger fa fa-times quitarSuscriptor"></span></td>
                <td></td>
            </tr>';
        }


    }


    #FUNCION QUE ACTUALIZA EL ESTADO DEL SUSCRIPTOR
    public function actualizarEstadoSuscriptorController($datos)
    {
        $respuesta = @GestorContactoModel::actualizarEstadoSuscriptorModel($datos, 'suscriptores');

        return $respuesta;
    }

}


?>