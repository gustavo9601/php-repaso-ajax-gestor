<?php

//destruimos las sesion
session_start();
session_destroy();

//hacmeos nulas las sesiones
$_SESSION['validar'] = [];
$_SESSION['usuario'] = [];

//me voy hacia el formualario de ingreso, parametro que recibira enlaces.php
header('Location: ingreso');


?>