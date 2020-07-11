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
SUSCRIPTORES
======================================-->

<div id="suscriptores" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">

    <div>

        <table id="tablaSuscriptores" class="table table-striped dt-responsive nowrap">
            <thead>
            <tr>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Email</th>
                <th>Acciones</th>
                <th></th>
            </tr>
            </thead>
            <tbody>


            <?php

            $llamandoSuscriptores = NEW GestorContactoConroller();
            $llamandoSuscriptores->todosLosSuscriptoresController();

            ?>
            <!--<tr>
                <td>John</td>
                <td>Doe</td>
                <td>john@example.com</td>
                <td><span class="btn btn-danger fa fa-times quitarSuscriptor"></span></td>
                <td></td>
            </tr>-->


            </tbody>
        </table>

        <a class="btn btn-warning pull-right botonImprimePDF" style="margin:20px;" href="reporteWord">Imprimir Suscriptores Word</a>
        <a class="btn btn-warning pull-right botonImprimePDF" style="margin:20px;" href="reporteExcel">Imprimir Suscriptores Excel</a>
    </div>

</div>

<!--====  Fin de SUSCRIPTORES  ====-->