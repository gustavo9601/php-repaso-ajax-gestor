<?php

header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=Reporte_Personal_usuarios.doc");


?>

<!--=====================================
SUSCRIPTORES
======================================-->


<!doctype html>
<html lang="s">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style type="text/css">
        * {
            box-sizing: border-box;
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        }

        h1, h3 {
            text-align: center;
        }

        h3 {
            color: #898989;
        }

        div.contenedor-central {
            width: 80%;
            margin: 0 auto;
        }

        table {
            border-collapse: collapse;
            border: 1px solid black;
        }

        caption {
            font-size: 2em;
        }

        table {

            font-size: 12px;
            margin: 45px;
            width: 100%;
            text-align: left;
            border-collapse: collapse;
        }

        th {
            font-size: 13px;
            font-weight: normal;
            padding: 2px;
            background: #b9c9fe;
            border-top: 4px solid #aabcfe;
            border-bottom: 1px solid #fff;
            color: black;
            text-align: center;
        }

        td {
            padding: 8px;
            background: #f8f8f8;
            color: #669;
            border-top: 1px solid transparent;
        }

        tr:hover td {
            background: #ecfff4;
            color: #339;
        }

        th, td, tr {
            border: 1px solid black;
        }
    </style>
    <title>Document</title>
</head>
<body>

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



    </div>

</div>
</body>
</html>

