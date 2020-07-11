<?php

class Ingreso {

    public function ingresoController() {

        if (isset($_POST['submitIngreso'])) {

            //preg_match -> retornara true si cumple con la variable o texto regular
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['usuarioIngreso'] &&
                            preg_match('/^[a-zA-Z0-9]+$/', $_POST['passwordIngreso']))) {


                // Encriptamos la contrasña con MD5
                //$contraseñaEncriptada = crypt($_POST['passwordIngreso'], '$1$rasmusle$rISCgZzpwk3UhDidwXvin0');
                //gurdamos en un array lo que se envia por le formulario
                $datosController = [
                    "usuario" => $_POST['usuarioIngreso'],
                    "password" => $_POST['passwordIngreso']
                ];

                //en una varaible , ejecutamos la funcion de la clase IngresoModels,
                //que esta a su ves retorna algo
                $respuesta = @IngresoModels::ingresoModel($datosController);

                //capturamos el id del usuario;
                $usuarioActual = $respuesta['usuario'];
                //varaible que contrlora los itnentos
                $intentos = $respuesta['intentos'];
                //echo "numero intentos  $intentos";

                $maximoIntentos = 2;

                //validamos que la cantidad de intentos sea menor al maximo
                if ($intentos < $maximoIntentos) {
                    /*  echo '<pre>';
                      print_r($respuesta); */

                    //condicional que valida lo que devuelva la variable respuesta con lo que se escriba en el formulario POST
                    if (!empty($respuesta) && $respuesta['usuario'] == $_POST['usuarioIngreso'] && $respuesta['password'] == $_POST['passwordIngreso']) {
                        //resteamos los errores de intento del susuario
                        $intentos = 0;

                        //creamos un array que pasaremos ala bd para que update alos itentos
                        $arrayActualizaIntentos = [
                            'usuario' => $usuarioActual,
                            'intentos' => $intentos
                        ];
                        //actualziadcion de los intentos deingreso
                        $respuestaActualzarIntentos = @IngresoModels::intentosModel($arrayActualizaIntentos);


                        //cremamos la sesion
                        @session_start();
                        @$_SESSION['validar'] = true;
                        //creamo sla sesion con el nomnre de usuario de la BD
                        @$_SESSION['usuario'] = $respuesta['usuario'];
                        //redireccionamos
                        //el .htacces remplaza -> index.php?action= solo a inicio
                        header('Location: inicio');
                    } else {

                        //incremento en uno la variable
                        $intentos = $intentos + 1;

                        //echo 'intentos = ' . $intentos;
                        //creamos un array que pasaremos ala bd para que update alos itentos
                        $arrayActualizaIntentos = [
                            'usuario' => $usuarioActual,
                            'intentos' => $intentos
                        ];

                        //llamamos al metodo y actualizamos los datos
                        $respuestaActualzarIntentos = @IngresoModels::intentosModel($arrayActualizaIntentos);

                        echo "<div class='alert alert-danger'>Error al ingresar</div>";
                    }
                } else {
                    //resteamos la variable
                    $intentos = 0;

                    // echo 'intentos = ' . $intentos;
                    //creamos un array que pasaremos ala bd para que update alos itentos
                    $arrayActualizaIntentos = [
                        'usuario' => $usuarioActual,
                        'intentos' => $intentos
                    ];

                    //llamamos al metodo y actualizamos los datos
                    $respuestaActualzarIntentos = @IngresoModels::intentosModel($arrayActualizaIntentos);

                    //mostramos el error
                    echo "<div class='alert alert-danger'>Ha Fallado mas de 3 Veces, Intenlo mas tarde</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>No se permiten caracteres Especiales</div>";
            }
        }
    }

}

?>