<?php

class Slide
{
    public function seleccionarSlideController()
    {

        //funcion que llama al modelo del fronted y devuelve todos os slide
        $respuesta = @SlideModels::seleccionarSlideModel('slide');

/*      echo '<pre>';
        print_r($respuesta);*/

//subst() -> sustramemos los primero caracteres que vengan
        foreach ($respuesta as $row => $item) {
            echo '<li>
                <img src="backend/'. substr($item['ruta'],6) . '">
                <div class="slideCaption">
                    <h3>' .$item['titulo']. '</h3>
                    <p>'.  $item['descripcion'] .'</p>
                </div>
                </li>';
        }


    }

}


?>