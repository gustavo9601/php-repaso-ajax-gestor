<?php

session_start(); //iniciamos sesion
//validamos si esa variable trae algo y que no sa falsa
if(isset($_SESSION['validar']) && $_SESSION['validar']){

    header('Location: inicio');

    exit(); //salimos del script
}
?>

<!--=====================================
FORMULARIO DE INICIO DE SESION
======================================-->
<div id="backIngreso">
    <form method="post" id="formIngreso" onsubmit="return validarIngreso()">
        <h1 id="tituloFormIngreso">INGRESO AL PANEL DE CONTROL</h1>
        <input id="usuarioIngreso" class="form-control formIngreso" type="text" placeholder="Ingrese su Usuario"
               name="usuarioIngreso">
        <input id="passwordIngreso" class="form-control formIngreso" type="password" placeholder="Ingrese su Contraseña"
               name="passwordIngreso">

            <?php

            //ejecutamos la funcion del contrllador de ingreso
            $llamandoControllerIngreso = NEW Ingreso();
            //ejecutando la funcion
            $llamandoControllerIngreso->ingresoController();
            ?>



        <input class="form-control formIngreso btn btn-primary" type="submit" name="submitIngreso" value="Enviar">


    </form>


</div>


<!--====  Fin de FORMULARIO DE INGRESO ====-->