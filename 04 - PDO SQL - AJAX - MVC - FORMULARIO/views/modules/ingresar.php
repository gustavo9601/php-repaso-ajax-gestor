<h1>INGRESAR</h1>

<!--Con $_SERVER['PHP_sELF'] indico que se jecutara en este mismo archvio-->
	<form method="post" action="">
		
		<input type="text" placeholder="Usuario" name="usuarioIngreso" required>

		<input type="password" placeholder="Contraseña" name="passwordIngreso" required>

		<input type="submit" value="Enviar">

	</form>


<?php session_start();

if(@$_SESSION['validar'] != false){
//si existe la session validar se redireccionara a usuarios, ya que no tiene logica logearse y poder ingresar de nuevo
	header('Location: index.php?action=usuarios');

	exit(); //salimos del script por seguridad
}




//llamando a los objetos de ingreso
$ingreso = NEW MvcController();
$ingreso->ingresoUsuarioController();  //ejecutando la funcion desde el controllador

//validamos si por get la variable action tiene algo, deovlera en la vista los condicionales que se le indiquen
if(isset($_GET['action']) ){

	if($_GET['action'] == 'fallo'){
		echo "<h1>Usuario o Contraseña Incorrecta Numero de Intenos:" . $_GET['intentos'] . "</h1>";
	}
	//se valida si se pasa por parametro fallo intentos
	if($_GET['action'] == "falloIntentos" ){
		echo "<h1>Ha fallado 5 Veces el formulario, estas bloqueado</h1>";
	}
}





?>