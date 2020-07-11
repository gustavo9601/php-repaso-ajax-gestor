<?php

//validamos que la session este iniciado
session_start();
if (@!$_SESSION['validar']) {
//si no existe o es falsa, se redireccionara al menu inicio como action ingresar
    header('Location: index.php?action=ingresar');

    exit(); //salimos del script por seguridad
}


$registro = NEW MvcController();
$registro->borrarUsuarioController();
//$registro->vistaUsuarioController(); //trallenoo la consulta de usuarios
?>

<h1>USUARIOS</h1>

<table border="1">

    <thead>

    <tr>
        <th>Usuario</th>
        <th>Contraseña</th>
        <th>Email</th>
        <th></th>
        <th></th>

    </tr>

    </thead>

    <tbody>

    <!--Trallendo desde la BD y vistaUsaiorController accdemos atravez de la instancia del objeto-->
    <?php foreach ($registro->vistaUsuarioController() as $fila): ?>
        <tr>
            <td><?php echo $fila['usuario']; ?></td>
            <td><?php echo $fila['password']; ?></td>
            <td><?php echo $fila['email']; ?></td>
            <td>
                <!--$  -> siginifica que presede otra varaible get y pasamos el idcada vez que se de click-->
                <button><a href="index.php?action=editar&id=<?php echo $fila['id']; ?>">Editar</a></button>
            </td>
            <td>
                <!--PASARA EL ID POR LA URL A BORRAR y se deovlovera a la misma pagina para que recargue el query inicial-->
                <button><a href="index.php?action=usuarios&idBorrar=<?php echo $fila['id']; ?>">Borrar</a></button>
            </td>
        </tr>
    <?php endforeach; ?>


    </tbody>


</table>

<?php
//validamos que se halla enviado por GET y que la variable action sea igual a cambio
if (isset($_GET['action'])) {

    if ($_GET['action'] == 'cambio') {
        echo "<h1>Actualizacion Existosa</h1>";
    }
}
?>
