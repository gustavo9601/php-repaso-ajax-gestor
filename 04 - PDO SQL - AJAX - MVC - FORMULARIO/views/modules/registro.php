
<!--Formulario de Envio-->
<h1>REGISTRO DE USUARIO</h1>

<!--onSubmit -> ejecutara la funcion de javascript
al decirle return, se ejcutara el formulario solo si se retoran en la funcion true
con required, hacemos que si o si se escriba la informacion del formulario


-->
<form method="post" action="" onsubmit="return validarRegistro()" id="formulario">
	<label for="usuarioRegistro">USUARIO: <span id="mostrarError"></span></label>
	<!--maxlength = "10" escpecifico el limite de letras a esrbir-->
	<input type="text" id="usuarioRegistro" placeholder="Nombre Max 6 Caracteres" name="usuarioRegistro" maxlength="6" required>
	<label for="passwordRegistro">PASSWORD:</label>
	<input type="password" id="passwordRegistro" placeholder="Minimo 6 Caracteres, incluir Numeros y una Mayuscula" name="passwordRegistro" required>
	<label for="emailRegistro">EMAIL:<span id="mostrarError"></span></label>
	<input type="email" id="emailRegistro" placeholder="Email Correcto" name="emailRegistro" required>
	<p style="text-align: center">
		<input type="checkbox" name="" id="terminos">
		<a href="#">Acepta Terminos y Condiciones</a>
	</p>
	<input type="submit" value="Enviar">

</form>

<?php session_start();

if(@$_SESSION['validar'] != false){
//si existe la session validar se redireccionara a usuarios, ya que no tiene logica logearse y poder ingresar de nuevo
	header('Location: index.php?action=usuarios');

	exit(); //salimos del script por seguridad
}

//instancion un  objetod del controlador principal
$registro = NEW MvcController();
$registro->registroUsuarioController();

//validamos si por get la variable action tiene algo, deovlera en la vista los condicionales que se le indiquen
if(isset($_GET['action']) ){
	
	if($_GET['action'] == 'ok'){
		echo "<h1>Creacion Exitosa</h1>";
	}

}

?>