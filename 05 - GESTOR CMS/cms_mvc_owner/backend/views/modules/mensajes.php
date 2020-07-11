<?php
session_start(); //iniciamos sesion
//validamos si esa variable trae algo y que no sa falsa
if (@!isset($_SESSION['validar']) && @!$_SESSION['validar']) {
    //redireccionamos a igreso
    //el .htacces remplaza -> index.php?action= solo a ingreso
    header('Location: ingreso');
    exit(); //salimos del script
}

require_once 'views/modules/botonera.php';
require_once 'views/modules/cabezote.php';

?>

<!--=====================================
    MENSAJES
    ======================================-->

<div id="bandejaMensajes" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

    <div>
        <h2>Bandeja de Entrada</h2>
        <select class="selectpicker" id="mostrarVistosoNo">
            <option data-icon="glyphicon glyphicon-envelope" value="0"> NO LEIDOS</option>
            <option data-icon="glyphicon glyphicon-ok" value="1">  LEIDOS</option>
        </select>
        <hr>
    </div>


    <div class="muestraMensajesBandejaEntrada">
        <!--<div class="well well-sm">

      <span class="fa fa-times pull-right"></span>
      <h3>De: Lorem Ipsum</h3>
      <h5>Email: correo@correo.com</h5>
      <p>Lorem ipsum dolor sit amet, consectetur...</p>
      <button class="btn btn-info btn-sm">Leer</button>

  </div>-->

        <?php

        $llamandoMensajesSinLeer = NEW MensajesController();
        $llamandoMensajesSinLeer->mostrarMensajesSinVerController();

        ?>
    </div>


</div>

<div id="lecturaMensajes" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

    <div>
        <hr>
        <button class="btn btn-success" id="mostrarFormulario">Enviar mensaje</button>
        <hr>
    </div>

    <div id="mostrarEnviarMensaje" style="display: none;">
        <form action="">
            <div class="form-group">
                <label for="message-text" class="control-label">Selecciona el suscriptor:</label>
                <select class="selectpicker"   id="emailResponderEmail">

                    <?php
                    $llamandoEmails = NEW MensajesController();
                    $llamandoEmails->devuelveEmailsMensajeController();
                    ?>

                    <!--<option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>-->
                </select>


            </div>


            <input type="text" placeholder="Título del Mensaje" class="form-control" id="tituloResponderEmail">

            <textarea name="" id="mensajeResponderEmail" cols="30" rows="5" placeholder="Escribe tu mensaje..."
                      class="form-control"></textarea>

            <input type="button" class="form-control btn btn-primary" value="Enviar" id="enviarResponderEmail">


    </div>

    <!--<div class="well well-sm">

        <span class="fa fa-times pull-right"></span>
        <h3>De: Lorem Ipsum</h3>
        <h5>Email: correo@correo.com</h5>
        <p style="background:#fff; padding:10px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        <button class="btn btn-info btn-sm">Responder</button>

    </div>-->


</div>

<!--====  Fin de MENSAJES  ====-->