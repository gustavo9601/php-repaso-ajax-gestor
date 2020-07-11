<?php

//va a ser las veces de controlador
class GestorSlide
{

    #MOSTRAR IMAGEN SLIDE CON AJAX
    #-----------------------------------------
    public function mostrarImagenController($datos)
    {
        //metodo que permite listar las porpierades de una funcio
        // ancho y alto reemplazan a indices 0 y 1
        list($ancho, $alto) = getimagesize($datos['imagenTemporal']);

        //echo $ancho;
        //echo $alto;

        //getIamge -> funcion que obtiene las medidas de una iamgen
        // le pasamos loq ue pasen por parametro y accdemos al indice o pocision imagenTemporal
        //de esta forma devolveremos un array
        //print_r(getimagesize($datos['imagenTemporal']));


        /*Validando el tamaño de la imagen*/
        if ($ancho < 1600 || $alto < 600) {
            echo 0;  //retornamos un valor para que se compare
        } else {

            //numero aleatiori
            $aleatorio = mt_rand(100, 999);

            //de lo contrario devolvemos la ruta de la imagen,
            //y lo que devuelva el array que pasamos por paraemtro a la funcion
            $ruta = '../../views/images/slide/slide' . $aleatorio . '.jpg';
            //echo $ruta;  //devolvemos la variable

            //vamos a crear un archivo nuevo de jpg, y lo alamcenamos en una variable
            $origen = imagecreatefromjpeg($datos['imagenTemporal']);

            //recoratnado la imagen -> imageCrop() - Recorta una imagen usando las coordenada x y amcho y alto
            $destino = imagecrop($origen, ['x' => 0, 'y' => 0, "width" => 1600, "height" => 600]);

            //cargamos al serven (los datos de la iamge, ruta))
            imagejpeg($destino, $ruta);

            //ahora guardaremos en la bd la ruta de la imagen
            $respuesta = @GestorSlideModel::subirImagenSlideModel($ruta, 'slide');

            //devolvemos loq ue nos retorne la funcion
            //echo $respuesta;

            //funcion que devuelve todas las rutas
            $respuesta2 = @GestorSlideModel::mostrarImagenSlideModel($ruta, 'slide');

            //retornamos el array que nos devuele la consulta, y apuntamos
            $enviarDatos = [
                'ruta' => $respuesta2['ruta'],
                'titulo' => $respuesta2['titulo'],
                'descripcion' => $respuesta2['descripcion']
            ];
            //devovlvemos el array pero como lo recibe el Ajax en JS , lo encodeamos a json
            echo json_encode($enviarDatos);
        }

    }



    #MOSTRAR IMAGENES EN LA VISTA
    #-----------------------------------------
    public function mostrarImagenVistaController()
    {

        //llamo a la funcion del modelo y que me dvovlera el sselect
        $respuesta = @GestorSlideModel::mostrarImagenVistaModel('slide');

        //recorreidno lo que nos devoelvea la fucion
        //(arreglo, indice fila, resultado o valor))

        /* echo '<pre>';
         print_r($respuesta);*/

        foreach ($respuesta as $fila => $item) {
            //almacenando en una varaible
            $contenido = '<li id= "' . $item['id'] . '"class="bloqueSlide">
                          <span class="fa fa-times eliminarSlide" ruta="' . $item['ruta'] . '" ></span>
                          <img src="' . substr($item['ruta'], 6) . '" class="handleImg">
                          </li>';

            //le pasamos lo que nos deuvelve repsuesa,ta que sera el url de la imagne, y como es un json
            //aputamos al indicador ruta
            //usamos substr para que quite los primero 6 caracateres que no son necesarios

            echo $contenido;  //retornamos el contenido
        }

    }


    #FUNCION DE EDITAR LOS ELEMENTOS
    public function editorlSlideController()
    {
        //llamo a la funcion del modelo y que me dvovlera el sselect
        $respuesta = @GestorSlideModel::mostrarImagenVistaModel('slide');

        //recorreidno lo que nos devoelvea la fucion
        //(arreglo, indice fila, resultado o valor))

        /* echo '<pre>';
         print_r($respuesta);*/

        foreach ($respuesta as $fila => $item) {
            //almacenando en una varaible
            $contenido = '<li id="item-' . $item['id'] . '">
                            <span class="fa fa-pencil editarSlide" style="background:blue"></span>
                            <img src="' . substr($item['ruta'], 6) . '" style="float:left; margin-bottom:10px" width="80%">
                             <h1>' . $item['titulo'] . '</h1>
                             <p>' . $item['descripcion'] . '</p>
                         </li>';

            //le pasamos lo que nos deuvelve repsuesa,ta que sera el url de la imagne, y como es un json
            //aputamos al indicador ruta
            //usamos substr para que quite los primero 6 caracateres que no son necesarios

            echo $contenido; //retornamos lo que deuelve
        }

    }

    #FUNCION DE ELIMINAR ITEM DEL SLIDE
    public function eliminarSlideController($datos)
    {
        //llamo a la funcion del modelo ypara que lo eleimine
        $respuesta = @GestorSlideModel::eliminarSlideModel($datos, 'slide');

        echo $respuesta;//retornamos lo qu enos devuelva

        //unlink -> function que elimina lo que encuentre en un URL
        //papsamos el ural del array $datos
        unlink($datos['rutaSlide']);

    }

    #FUNCION DE ACTUALZIAR EL SLIDE AL MODIFICAR
    public function actualzarSlideController($datos)
    {
        //llamo a la funcion del modelo ypara que lo actualice
        @GestorSlideModel::actualizarSlideModel($datos, 'slide');
        //llamo a la funcion que deolvera la informacion una ve se halla actualizado
        $respuesta = @GestorSlideModel::seleccionarActualizacionSlideModel($datos, 'slide');


        //convertirmos en array para porder enviar lo que devuelve
        $enviarDatos = [
            'titulo' => $respuesta['titulo'],
            'descripcion' => $respuesta['descripcion'],
        ];

        echo json_encode($enviarDatos);//retornamos lo qu enos devuelva en formato json
    }

    #FUNCION QUE ACTUALIZARA EL ORDEN DE LOS SLIDES
    public function actualizarOrdenController($datos)
    {

        //llamando a la funcion que actuliazara el orden uno a uno por id
        $respuesta = @GestorSlideModel::actualizarOrdenModel($datos, 'slide');
        echo $respuesta;

    }

    #FUNCION QUE MUESTRA TODO EL SLIDE TERMINADO O COMO SE VERIA EN EL FRONTED
    public function mostrarSlideTerminadoController()
    {
        //llamando a la funcion que actuliazara el orden uno a uno por id
        $respuesta = @GestorSlideModel::mostrarSlideTerminadoModel('slide');
        /*         echo '<pre>';
                  print_r($respuesta);*/

//forach para mostrar todas las imagenes
        //con substr()  -> elimino la cantidad de primeras letras expeficiadas en el parametro
        foreach ($respuesta as $row => $item) {
            echo '<li>
                    <img src="' . substr($item['ruta'], 6) . ' ">
                    <div class="slideCaption">
                        <h3>' . $item['titulo'] . '</h3>
                        <p>' . $item['descripcion'] . '</p>
                    </div>
                     </li>';

        }


    }


}

?>