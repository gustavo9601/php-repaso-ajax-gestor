<?php session_start();

if(@!$_SESSION['validar'] ){
//si no existe sesion se reidreccioanra a ingresar
	header('Location: index.php?action=ingresar');

	exit(); //salimos del script por seguridad
}


$llamadoController = NEW MvcController();

?>
<h1>EDITAR USUARIO</h1>

<form method="post" action="">

<?php $llamadoController->editarUsuarioController(); //llamando la funcion con los uinput ya rellenos?>
<?php $llamadoController->actualizarUsuarioController(); //llamando al afuncion que actualizara los datos?>
</form>

