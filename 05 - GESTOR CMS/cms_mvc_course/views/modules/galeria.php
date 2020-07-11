<div class="row" id="galeria">

    <hr>

    <h1 class="text-center text-info"><b>GALERÍA DE IMÁGENES</b></h1>

    <hr>

    <ul>

        <?php

        $imagenes = NEW Galeria();
        $imagenes->seleccionarGaleriaController();


        ?>
        <!--    <li>
                <a rel="grupo" href="views/images/galeria/photo01.jpg">
                    <img src="views/images/galeria/photo01.jpg">
                </a>
            </li>-->


    </ul>

</div>