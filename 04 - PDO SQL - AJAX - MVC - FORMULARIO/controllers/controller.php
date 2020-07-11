<?php

class MvcController
{

    #LLAMADA A LA PLANTILLA
    #-------------------------------------

    public function pagina()
    {

        include "views/template.php";

    }

    #ENLACES
    #-------------------------------------

    public function enlacesPaginasController()
    {

        if (isset($_GET['action'])) {

            $enlaces = $_GET['action'];

        } else {

            $enlaces = "index";
        }

        @$respuesta = Paginas::enlacesPaginasModel($enlaces);

        include_once $respuesta;

    }


    #FUNCION DE REGISTRO DE USUARIOS -------------------
    public function registroUsuarioController()
    {

//validamos que se halla enviado POST y que sea el submit de name usuario
        if (isset($_POST['usuarioRegistro'])) {

            //validando como segundo firltro de informacion
            #breg_match = relaiza una comparacion con una exprecion regulat
            //recibe por parametro la exprcion regulara, y la variable a validar, si pasa el filtro se ejcutara lo siguente
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['usuarioRegistro'])
                && preg_match('/^[a-zA-Z0-9]+$/', $_POST['passwordRegistro'])
                && preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['emailRegistro'])
            ) {

                //Funcion que recibira atravez del metodo post lo que traiga el formulario de registros


                //crypt() -> funcion que hashea la contraseña en un algoritmo DES
                //1 parametros-> lo que se pasa a encriptar
                //2. parametro -> tipo de encriptacion
                $encriptar = crypt($_POST['passwordRegistro'], '$2a$07$usesomesillystringfore2uDLvp1Ii2e./U9C8sBjqp8I90dH6hi');


                //fuadamos en un array lo que deuvela el metodo post
                $datosController = [
                    "usuario" => $_POST['usuarioRegistro'],
                    "password" => $encriptar,
                    "email" => $_POST['emailRegistro']
                ];

                //@ para que no arrije los warning
                //accedemos a la clase Datos del archivo Crud, y a la funcion y le pasamos lo parametros requerudos
                @$respuesta = Datos::registroUsuarioModel($datosController, 'usuarios'); //suarios es el nombre de la tabla

                //de esta forma el controller solo sera el punete y MODELO o CRUD se encargara de procesar con la BD

                //la funcion Datos que guardams en respuesta devoelvera un booleano

                if ($respuesta) {
                    //si es true la vaeaible se recarfara, esto para que los values volcados en memoria se restablescan
                    header('Location:index.php?action=ok');
                } else {
                    echo "error";
                    //header('Location:index.php');
                }
            } else {
                echo '<h1>No cumple con las condiciones</h1>';
            }
        }
    }


    #FUNCION DE INGRESO DE USUARIOS -------------------
    public function ingresoUsuarioController()
    {

//validando como segundo firltro de informacion
        #breg_match = relaiza una comparacion con una exprecion regulat
        //recibe por parametro la exprcion regulara, y la variable a validar, si pasa el filtro se ejcutara lo siguente
        if (@preg_match('/^[a-zA-Z0-9]+$/', $_POST['usuarioIngreso'])
            && preg_match('/^[a-zA-Z0-9]+$/', $_POST['passwordIngreso'])
        ) {

            //validamos que     se halla enviado POST y que sea el submit de name usuarioIngreso
            if (isset($_POST['usuarioIngreso'])) {

                //Funcion que recibira atravez del metodo post lo que traiga el formulario de registros

                //crypt() -> funcion que hashea la contraseña en un algoritmo DES
                //1 parametros-> lo que se pasa a encriptar
                //2. parametro -> tipo de encriptacion
                $encriptar = crypt($_POST['passwordIngreso'], '$2a$07$usesomesillystringfore2uDLvp1Ii2e./U9C8sBjqp8I90dH6hi');


                //fuadamos en un array lo que deuvela el metodo post
                $datosController = [
                    "usuario" => $_POST['usuarioIngreso'],
                    "password" => $encriptar,
                ];

                //guardo en una varaible lo que retorne la funcion del modelo, pasando lo sparametros requeridos
                @$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
                /*
                                echo '<pre>';
                                print_r($respuesta);*/


                $usuario = $datosController['usuario']; //almacenamos en una varaible lo que se pase por el POST
                $contraseña = $datosController['password'];  //alamcena en una variable lo que se pase por el psot

                $intentos = $respuesta['intentos']; //accediendo a la columna intentos de la consulta y alamcenando en una varaible

                $maximoIntentos = 5;

                //Condicional que valida si hay menos de 2 intentos generara la sesion
                if ($intentos < $maximoIntentos) {
                    //imprimiendo si devuevuelve algo lo que se retorna
                    //print_r($respuesta) ;

                    //si no esta vacia se reidijira a la pagina usuariuos
                    // y cumple con lo devuleto
                    if ($respuesta['usuario'] == $usuario && $respuesta['password'] == $contraseña) {
                        //iniciadmos sesion
                        @session_start();
                        //creamos una varaible de sesion para usar para validar con los demas archivos
                        @$_SESSION["validar"] = "verdadero";
                        //redireccionamos a usuarios

                        //resteamos los intentos
                        $intentos = 0;
                        $datosIntentosController = [
                            "usuarioActual" => $usuario,
                            "actualizarIntentos" => $intentos
                        ];
                        //creamos una varaible , que invoca a la funcion de la clase datos y pasamos los parametros
                        $respuestaActualizarIntentos = @Datos::intentosUsuarioModel($datosIntentosController, 'usuarios');


                        //reidreccionamos a susuarios
                        header('Location: index.php?action=usuarios');
                    } else {

                        $intentos = $intentos + 1;  //incrementamos de a 1
                        //creamos un arrray que almacene el usuario actual y la cantidad de intentos, para ir
                        //haciendo el update a la bd

                        $datosIntentosController = [
                            "usuarioActual" => $usuario,
                            "actualizarIntentos" => $intentos
                        ];

                        //creamos una varaible , que invoca a la funcion de la clase datos y pasamos los parametros
                        $respuestaActualizarIntentos = @Datos::intentosUsuarioModel($datosIntentosController, 'usuarios');


                        //echo "Numero de intentos fallidos = $intentos";
                        //redireccionamos pero pasando por parametro el fallo
                        header('Location: index.php?action=fallo&intentos=' . $intentos . '');
                    }

                    //si llega hasta aqui fue porque supero la cantidad deintentos por usuarios
                } else {
                    //reseteamos intentos
                    $intentos = 0;

                    //vovlemos a actualizar los intentos
                    $datosIntentosController = [
                        "usuarioActual" => $usuario,
                        "actualizarIntentos" => $intentos
                    ];

                    //creamos una varaible , que invoca a la funcion de la clase datos y pasamos los parametros
                    $respuestaActualizarIntentos = @Datos::intentosUsuarioModel($datosIntentosController, 'usuarios');

                    //redireccionamos y pasamos por get que fall todos los itnetneos
                    header('Location: index.php?action=falloIntentos');
                }
            }
        }
    }


    #FUNCION QUE TRAERA EL LISTADO DE USUARIOS
    public function vistaUsuarioController()
    {
        //varaible que invoca que alamcena lo que retorne la funcion del modelo, y l epasamos la tabla
        @$respuesta = Datos::vistaUsuarioModel();

        //imprimiendo lo que devuelva al funcion
        /*echo '<pre>';
        print_r($respuesta);*/
        //reotnrando la respuesta
        return $respuesta;
    }

    #FUNCION PARA EDITAR LA INFORMACION DE USUARIO Y RECIBIE POR GET EL ID
    public function editarUsuarioController()
    {
        $id = $_GET['id']; //capturamos el valor que se pase a la variable get id

        //echo $id;
        //guardamos en una varaible lo que nos retorne la funcion del modelo pasando el id
        @$respuesta = Datos::editarUsuarioModel($id);

        /*  echo '<pre>';
          print_r($respuesta);*/

        /* OTRA FORMA DE MOSTRAR EN LA VISTA LA INFORMACION*/
        //usamos un input escondido para almecenar temporalmente el id y luego usarlo para actualizar
        echo '  <input type="hidden" name="idEscondidoEditar"  value="' . $respuesta["id"] . '" >
        
                <input type="text" value="' . $respuesta["usuario"] . '" name="usuarioEditar" required>

	            <input type="text" value="' . $respuesta["password"] . '" name="passwordEditar" required>

	            <input type="email" value="' . $respuesta["email"] . '" name="emailEditar" required>

	            <input type="submit" value="Acualizar">';
    }


    #FUNCION DE ACTUALIZAR LA INFORMACION DEL USUARIO
    public function actualizarUsuarioController()
    {


        //validando como segundo firltro de informacion
        #breg_match = relaiza una comparacion con una exprecion regulat
        //recibe por parametro la exprcion regulara, y la variable a validar, si pasa el filtro se ejcutara lo siguente
        if (@preg_match('/^[a-zA-Z0-9]+$/', $_POST['usuarioEditar'])
            && preg_match('/^[a-zA-Z0-9]+$/', $_POST['passwordEditar'])
            && preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['emailEditar'])
        ) {


            //crypt() -> funcion que hashea la contraseña en un algoritmo DES
            //1 parametros-> lo que se pasa a encriptar
            //2. parametro -> tipo de encriptacion
            $encriptar = crypt($_POST['passwordEditar'], '$2a$07$usesomesillystringfore2uDLvp1Ii2e./U9C8sBjqp8I90dH6hi');

            //validamos si la variable post este llena o sea se halla escpichado el subimit
            if (isset($_POST['usuarioEditar'])) {
                //guardamos en una variable lo que se pase en el formulario
                $datos = [
                    "id" => $_POST['idEscondidoEditar'],
                    "usuario" => $_POST['usuarioEditar'],
                    "password" => $encriptar, //Enviamos la contraseña encriptada
                    "email" => $_POST['emailEditar']
                ];

                /*            echo '<pre>';
                            print_r($datos);*/


                //guradamos e nuna variable lo que retoenr la funcion de la clas emodelo y pasamos el array como paraemtro
                @$respuesta = Datos::actualizarUsuarioModel($datos);

                //de aceurdo a lo que nos devuelva si se hizo o no el update se redireccionara
                if ($respuesta) {
                    header('Location: index.php?action=cambio');
                } else {
                    echo '<h1>Error No se pudo actualizar</h1>';
                }
            }
        } else {
            //echo '<h1>No se pudo actualizar por ingfraccion</h1>';
        }
    }


    #FUNCION DE BORRAR LOS USUARIOS AL DAR CLICK
    public function borrarUsuarioController()
    {
//validamos que halla infomacion en la varaible get
        if (isset($_GET['idBorrar'])) {
            $id = $_GET['idBorrar'];

            /*echo $id;*/

            //gurdamos en una variable lo que retorne la accion de eliminar
            @$respuesta = Datos::borrarUsuarioModel($id);

            if ($respuesta) {
                //refrescara la pagina usuarios
                header('Location: index.php?action=usuarios');
            } else {
                echo "<h1>No se pudo eliminar</h1>";
            }
        }


    }


#FUNCION QUE VALIDA USUARIO EXISTENTE -> LLAMADA DESDE PHP Y Q A SU VEZ HACE CONEXION CON AJAX
    public function validarUsuarioController($datosController)
    {
        $datos = $datosController;

        //invoco a una funcion del modelo y le paso el parametro
        $respuesta = @Datos::validarUsuarioModel($datosController);

        //count -> devuelve cuantos caracteres ttrae la variable
        // respuesta - > devuelve lo que retorna la funcion y accdemos al incide de usuario
        if (count($respuesta['usuario']) > 0) {
            echo 0; //devolvemos 0 de ser mayor 0
        } else {
            echo 1;
        }
    }


    public function validarEmailController($datosController)
    {
        $datos = $datosController;

        //invoco a una funcion del modelo y le paso el parametro
        $respuesta = @Datos::validarEmailModel($datosController);

        //count -> devuelve cuantos caracteres ttrae la variable
        // respuesta - > devuelve lo que retorna la funcion y accdemos al incide de usuario
        if (count($respuesta['email']) > 0) {
            echo 0; //devolvemos 0 de ser mayor 0
        } else {
            echo 1;
        }
    }


}

?>