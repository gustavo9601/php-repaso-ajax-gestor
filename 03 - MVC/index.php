<?php

/*
 * El index mostraremos la salida de las vistas del usuario
 * y enviaremos las distitnas acciones que el usuario envie al controlador
 * */

//incluqyendo el controlador
require_once 'controllers/controller.php';
require_once 'models/modelo.php';

$mvc = new MvcController();
$mvc -> plantilla(); //trayendo la funcion plantailla que incluye la vista


?>