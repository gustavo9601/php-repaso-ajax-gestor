<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Plantilla</title>

    <style>
        <style>

        header{
            position:relative;
            margin:auto;
            text-align:center;
            padding:5px;
        }

        nav{
            position:relative;
            margin:auto;
            width:100%;
            height:auto;
            background:black;
        }

        nav ul{
            position:relative;
            margin:auto;
            width:50%;
            text-align: center;
        }

        nav ul li{
            display:inline-block;
            width:24%;
            line-height: 50px;
            list-style: none;
        }

        nav ul li a{
            color:white;
            text-decoration: none;
        }

        section{
            position:relative;
            padding:20px;
        }
    </style>

</head>
<body>
<header>
    <h1>LOGOTIPO</h1>
</header>
<!--Invocando el paratado de navegacion-->
<?php include_once 'modules/navegacion.php';?>

<?php
//creamos la instancia del controlado
    $mvc = new MvcController();
//invocamo sla funcion , que devuevle que se paso por la utl
//metodo GET en la araible action
    $mvc -> enlacesPaginasController();
?>
<section>
  <!--  <h1>PAGINA DE INICIO</h1>-->
</section>
</body>
</html>