<!--=====================================
     CABEZOTE
    ======================================-->


<div id="cabezote" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

        <ul>
            <li style="background: #333">
                <a href="mensajes" style="color: #fff">
                    <i class="fa fa-envelope"></i>
                    <span id="cantidadMensajes">


                        <?php
                        $llamandoCantidadMensajes = NEW MensajesController();
                        $llamandoCantidadMensajes->cantidadDeMensajesSuscritoresNuevos();

                        ?>

                    </span>
                </a>
            </li>

            <li style="background: #333">
                <a href="suscriptores" style="color: #fff">
                    <i class="fa fa-bell"></i>
                    <span id="cantidadSuscriptores">
                        <?php
                        $llamandoCantidadMensajes->cantidadDeMensajesSuscritoresNuevos();
                        ?>

                    </span>
                </a>
            </li>

        </ul>

    </div>

    <div id="time" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">


        <div class="text-center fechaActual">
            <?php
            //FECHA
            echo date("l") . ", " . date("d") . " de " . date("F") . " de " . date("Y");
            ?>
        </div>
        <div class="text-center horaActual">
            <?php
            //configurando la zona horaria
            date_default_timezone_set("America/Bogota");

            //TIME
            echo "<p id='mostrarHora'>" . date("h") . ":" . date("i") . ":" . date("s") . " " . date("a") . "</p>";

            echo "<div id='hora' hora='" . date('h') . "' segundos='" . date("s") . "' minutos='" . date("i") . "' meridiano='" . date('a') . "'></div>";
            ?>
        </div>


    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">

        <img src="views/images/photo.jpg" class="img-circle">

        <p id="member"><?php echo @$_SESSION['usuario']; ?> <span class="fa fa-chevron-down"></span>
            <br>
        <ol id="admin">
            <li><a href="perfil"><span class="fa fa-user"></span>Editar Perfil</a></li>
            <li><a href=""><span class="fa fa-file-text"></span>Términos y Condiciones</a></li>
            <li><a href="salir"><span class="fa fa-times"></span>Salir</a></li>
        </ol>

        </p>

    </div>

</div>

<!--====  Fin de CABEZOTE  ====-->

<script>
    /*============================
     * RELOG DINAMICO
     * ==========================*/


    function reloj() {
        //capturamos del div, el atributo segundos
        segundos = $("#hora").attr("segundos");
        //capturamos la hora del div
        hora = $('#hora').attr("hora");
        //minutos
        minutos = $('#hora').attr("minutos");
        //meridiano
        meridiano = $('#hora').attr("meridiano");


        //se ejecutara cada segundo
        setInterval(function () {
            console.log(hora + ":" + minutos + ":" + segundos + " " + meridiano);


            if (segundos > 58) {
                minutos++;
                segundos = 0 + "0";
            } else {
                segundos++;
                if (segundos > 0 && segundos < 10) {
                    segundos = "0" + segundos++;
                }
            }

            if(minutos > 59){
                //cada hora la pagina se regcargara
                window.location.reload();
            }


            //modifcamos el html de la hora
            $('div.horaActual').html(hora + ":" + minutos + ":" + segundos + " " + meridiano);

        }, 1000);
    }

    reloj();

</script>