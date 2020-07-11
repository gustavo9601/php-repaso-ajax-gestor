<h1>¡Haz salido de la aplicación!</h1>
<?php
session_start();
if(@$_SESSION['validar'] != true){
//si es falsa la sesion o no existe pues no podra serrara y se redireccinara a ingresar
    header('Location: index.php?action=ingresar');

    exit(); //salimos del script por seguridad
}


//destruimos la session
session_destroy();
$_SESSION['validar'] = []; //hacemos nula la sesio
?>