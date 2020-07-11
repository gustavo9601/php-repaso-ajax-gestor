<?php

//Importando archivos
require_once 'models/crud.php'; //conexion con la BD
require_once "controllers/controller.php"; //controlador de la APP, intermedia entre el modelo y vista
require_once "models/enlaces.php"; //archivo encargado de validar las url por parametro GET y redireccionar

$mvc = new MvcController();
$mvc -> pagina();

?>