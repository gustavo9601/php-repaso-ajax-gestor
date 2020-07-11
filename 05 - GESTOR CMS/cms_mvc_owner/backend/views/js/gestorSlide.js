/*
 * Este archivo lanzara peticiones tipo AJAX
 * */



/*===================================*/
//Are ade arraaste de imagenes

//mostrare el html que contenie el id
console.log($('#columnasSlide').html());

//condicional que valida si hay algo dentro de las etiquetas
//de lo contrario con css mmodificara el alto
if ($('#columnasSlide').html() == 0) {
    $('#columnasSlide').css({
        "height": "100px"
    });
} else {
//de lo contrario si ya contiene informacion el alto sera dinamico
    $('#columnasSlide').css({
        "height": "auto"
    });
}

//FIN DE AREA ARRASTERE
/*===================================*/


/*===================================*/
//Subir una imagen

/*Funcion que captura el evento al jalar una imagen sobre el recuado*/
$('#columnasSlide').on('dragover', function (e) {

    e.preventDefault();  //quitamos acciones pretdeterminadas de navegador,
    //para que no se abra en una nueva ventana cuando se haga drog
    e.stopPropagation();   //detenemos la proparagcion de un evento

    console.log("Se recibio en ajax la imagen");

    //le cambiamos el fondo al contenedor
    //para validar que si s e arrastro una imagen
    $('#columnasSlide').css({
        "background": "url(views/images/pattern.jpg)"
    });


});

/*================FIN DE SUBIR IMAGEN============*/


/*===================================*/
//Soltar una imagen

$('#columnasSlide').on('drop', function (e) {

    e.preventDefault();  //quitamos acciones pretdeterminadas de navegador,
    //para que no se abra en una nueva ventana cuando se haga drog
    e.stopPropagation();
    //cuando se suelte la imagen cambiara de nuevo el fondo
    $('#columnasSlide').css({
        "background": "white"
    });

    //guardamos en una varaible la imagen que se cargo al jalar
    var archivo = e.originalEvent.dataTransfer.files;

    //imprirmios lo que nos devuelve
    console.log(archivo);

    var imagen = archivo[0]; //vamos a trabajar con las propiedades del indice 0
    var imagenSize = imagen.size;  //guardamos el peso de la imagen
    console.log("Peso = " + imagenSize);


    //hacmeos cast de la variable imagenSize, ya que el array no lo devuevle en string
    if (Number(imagenSize) > 1000000) {
        //insertaremos una alerta dentro del contenedor
        $('#columnasSlide').before(
            '<div class="alerta alert alert-warning text-center">El archivo excede el peso de 200 KB</div>'
        );
    } else {
        //de lo contrario si existe esa clase creada la removemos
        $('.alerta').remove();
    }


    //vamos a validar el tipo de imagen
    var imagenType = imagen.type;
    console.log(imagenType);
    if (imagenType == 'image/jpeg' || imagenType == 'image/png') {
        //de lo contrario si existe esa clase creada la removemos
        $('.alerta').remove();
    } else {
        //insertaremos una alerta dentro del contenedor
        $('#columnasSlide').before(
            '<div class="alerta alert alert-warning text-center">El archivo debe ser formato JPG o PNG</div>'
        );
    }

//Subir imagen al servidor, volvermos a validar que se cumpla las oncidicones
    if ((Number(imagenSize) < 1000000) && imagenType == 'image/jpeg' || imagenType == 'image/png') {
        //creamos una varaible donde alamcenamos e insertarmos la informacion
        //de la imagen a enviar por ajax
        var datos = new FormData();
        datos.append("imagen", imagen);
        //peticion ajax
        $.ajax({
            url: "views/ajax/gestorSlide.php", //url del archivo que recibira la peticion
            method: "POST",
            data: datos, //varaible o informacion a enviar
            cache: false,  //limpiamos cache,
            contentType: false,
            processData: false,
            dataType: "json",  //espcificando el tipo de dato a recibir
            beforeSend: function () { //con beforeSend detectamos el momento en que esta cargando y no ha finalizadp

                $("#columnasSlide").before('<img src="views/images/status.gif" id="status" >');

            },
            success: function (respuesta) {  //succes -> evento que detenta que se completo efectivamnte
                //succes -> evento que detenta que se completo efectivamnte

                console.log(respuesta); //imprimos lo que nos devuelve

                $('#status').remove(); //removemos el status

                if (respuesta == 0) {
                    //si es 0 es por que el contrllador devolio que no se cumple, mostramos la alerta
                    $('#columnasSlide').before(
                        '<div class="alerta alert alert-warning text-center">La imagen no cumple con las especificacion de ancho o alto</div>'
                    );
                } else {

                    console.log(respuesta);
                    //si no es 0 hacemos el apend en el body del ul y lo guardamos en una variable
                    var contenido = '';
                    contenido += '<li class="bloqueSlide" >';
                    contenido += '<span class="fa fa-times"></span>';
                    //le pasamos lo que nos deuvelve repsuesa,ta que sera el url de la imagne, y como es un json
                    //aputamos al indicador ruta
                    //slice extrae la posicion del dato del array
                    contenido += '<img src="' + respuesta['ruta'].slice(6) + '" class="handleImg">';
                    contenido += '</li>';


                    //para que se ajuste a la altura de la imagen
                    $('#columnasSlide').css({
                        "height": "auto"
                    });
                    //insertando cada ibheto en el contenedor
                    $('#columnasSlide').append(
                        contenido
                    );
                    //insertand cada elemento nuevo añaido abajo
                    var contenido2 = '';
                    contenido2 += '<li>';
                    contenido2 += '<span class="fa fa-pencil" style="background:blue"></span>';
                    contenido2 += '<img src="' + respuesta['ruta'].slice(6) + '" style="float:left; margin-bottom:10px" width="80%">';
                    var tituloProvisional = respuesta['titulo'] || ''; //variables que de ser Null cambioamos los valores a vacio
                    contenido2 += '<h1>' + tituloProvisional + '</h1>';
                    var descripcionProvisional = respuesta['descripcion'] || ''; //variables que de ser Null cambioamos los valores a vacio
                    contenido2 += '<p>' + descripcionProvisional + '</p>';
                    contenido2 += '</li>';
                    $('#ordenarTextSlide').append(
                        contenido2
                    );

                    //Opcion 1cuando finaliza la peticion ajax y la insercion en DOM
                    //recargamos para que el ultimo elemento inserado sea traido desde la BD y contrllador en PHP
                    //window.location.reload();

                    //Opcion 2
                    //Usarmoe el plugin sweet alert
                    swal({
                            title: "!OK",
                            text: "La imagen se subio Correctamente !",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        },
                        function (isConfirm) {  //validamos que se halla confirmado
                            if (isConfirm) {
                                window.location = "slide";  //si se confirmo se redireccionara a slide, ya que con el .htacces solo debemos pasar el final
                            }
                        });

                }

            }

        });
    }
});


/*================FIN DE SOLTAR IMAGEN============*/



/*==========================================*/
//ELIMINAR ITEM SLIDE

$('.eliminarSlide').on('click', function () {

    //validamos que cuando quede un slide, la columna vovlera a ser fija
    if ($('.eliminarSlide').length == 1) {
        $('#columnasSlide').css({
            "height": "100px"
        });
    }


    //capturamos el id del li clickeado
    //apuntando al padre y capturando el atributo
    var idSlide = $(this).parent().attr('id');
    console.log(idSlide);
    var rutaSlide = $(this).attr('ruta');
    console.log(rutaSlide);

    //a ese item que cliqueamos se removera
    $(this).parent().remove();

    //removemos tambien el elemneto de abajo que es el mismo para editar
    //tomando como flitro el id
    $('#item-' + idSlide).remove();


    //ahora creamos un ajax donde reciba el elemento a eliminar que sera el id
    var borrarItem = new FormData();
    //pasamos los parametros con las variables
    borrarItem.append('idSlide', idSlide);
    borrarItem.append('rutaSlide', rutaSlide);


    $.ajax({
        url: "views/ajax/gestorSlide.php", //url del archivo que recibira la peticion
        method: "POST",
        data: borrarItem, //varaible o informacion a enviar
        cache: false,  //limpiamos cache,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
        }
    });

});

/*================FIN DE ELIMINAR ITEM SLIDE============*/

/*==========================================*/
//EDITAR ITEM SLIDE
//cuando se de click sobre el span de editar
$('.editarSlide').on('click', function () {
    //le sacamos el id al padre LI
    var idSlide = $(this).parent().attr('id');
    console.log(idSlide);

    //capturamos el url de la imagen
    var rutaImagen = $(this).parent().children('img').attr('src');
    console.log(rutaImagen);
    //capturamos el html que tenga el h1
    var rutaTitulo = $(this).parent().children('h1').html();
    console.log(rutaTitulo);
    //capturando el htm que tenga el p
    var rutaDescripcion = $(this).parent().children('p').html();
    console.log(rutaDescripcion);
    //variable de html que reemplazara cuando se de click
    var contenido = '';
    contenido += '<img src="' + rutaImagen + '" class="img-thumbnail">';
    contenido += '<input id="enviarTitulo" type="text" class="form-control" placeholder="Título" value="' + rutaTitulo + '">';
    contenido += '<textarea id="enviarDescripcion" row="5" class="form-control" placeholder="Descripción" >' + rutaDescripcion + '</textarea>';
    contenido += '<button id="guardar-' + idSlide + '" class="btn btn-info pull-right" style="margin:10px">Guardar</button>';

    //modificamos el htm por la variable contenido
    $(this).parent().html(
        contenido
    );

    //validando cuando se de click sobre el boton guardar
    $('#guardar-' + idSlide).on('click', function () {


        var enviarId = idSlide.slice(5);  //le quitamos los primero 5 acaracteres
        console.log('Id despues de slice = ' + enviarId);

        var enviarTitulo = $('#enviarTitulo').val();  //guardamos lo que escribimos en los input
        var enviarDescripcion = $('#enviarDescripcion').val();

        //creamos las variables que se enviaran por ajax
        var actualizarSlide = new FormData();
        actualizarSlide.append('enviarId', enviarId);
        actualizarSlide.append('enviarTitulo', enviarTitulo);
        actualizarSlide.append('enviarDescripcion', enviarDescripcion);

        $.ajax({
            url: "views/ajax/gestorSlide.php", //url del archivo que recibira la peticion
            method: "POST",
            data: actualizarSlide, //varaible o informacion a enviar
            cache: false,  //limpiamos cache,
            contentType: false,
            processData: false,
            dataType: "json",  //espcificando el tipo de dato a recibir
            success: function (respuesta) {
                console.log(respuesta);

                //varaible de reemplazo con html, pero no esto no es neseario ya q se usa una alerta suave
                contenido3 = '';
                contenido3 += '<span class="fa fa-pencil editarSlide" style="background:blue"></span>';
                contenido3 += '<img src="' + rutaImagen + '" style="float:left; margin-bottom:10px" width="80%">';
                var tituloProvisional = respuesta['titulo'] || ''; //variables que de ser Null cambioamos los valores a vacio
                contenido3 += '<h1>' + tituloProvisional + '</h1>';
                var descripcionProvisional = respuesta['descripcion'] || ''; //variables que de ser Null cambioamos los valores a vacio
                contenido3 += '<p>' + descripcionProvisional + '</p>';
                //reemplazamos el codigo html por lo que devuelvea la ctaulziacion y la consulta
                $('#guardar-' + idSlide).parent().html(
                    contenido3
                );

                //Usaremos una alerta que nos diga que se cargo efectivamente para que recagrue la pagina
                swal({
                        title: "!OK",
                        text: "La imagen se Edito Correctamente !",
                        type: "success",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    },
                    function (isConfirm) {  //validamos que se halla confirmado
                        if (isConfirm) {
                            window.location = "slide";  //si se confirmo se redireccionara a slide, ya que con el .htacces solo debemos pasar el final
                        }
                    });
            }
        });


    });


});

/*================FIN DE EDITAR  ITEM SLIDE============*/


/*==========================================*/
//ORDENAR SLIDE *****************************
//vapturando la cantidad de elementos que hli que hay
var longitudElementos = $('#columnasSlide li').length;
console.log("Cantidad de item en el slide = " + longitudElementos);
var almacenarOrdenId = new Array();  //varaible que gaurdara el id de cada elemento
var ordenItem = new Array();
//click sobre el boton de ordenar
$('#ordenarSlide').on('click', function () {

    //mostramos el nuevo boton
    $('#guardarSlide').show();
    //escodemos el boton
    $('#ordenarSlide').hide();


//cambiamos el tipo de mouse que paraecera sobre los item
    $('#columnasSlide').css({
        'cursor': 'move'
    });

//escndemos los span de eliminar x
    $('#columnasSlide span').hide();


    //usamos el pluggin de JQUERY UI
    $('#columnasSlide').sortable({
            revert: true,   //si la muevo que se devuelva
            connectWith: '.bloqueSlide', //le digo que se conecte con cada uno de los LI hijos
            handle: '.handleImg',  //para que podamos agarrar desde la imagen
            stop: function (event) {
                for (var i = 0; i < longitudElementos; i++) {
                    //alamcenamos en un array el id de cada elemento hijo
                    almacenarOrdenId[i] = event.target.children[i].id;

                    //varaible que acumulara la posicion del modificada
                    ordenItem[i] = i + 1;

                    console.log('id del elemento <i> = ' + almacenarOrdenId[i]);
                    console.log('Orden de posicion que se actualizara en la bd = ' + ordenItem[i]);

                }

            }
        }
    );

});


$('#guardarSlide').on('click', function () {
    //ocultamos el nuevo boton
    $('#guardarSlide').hide();
//mostramos el viejo boton boton
    $('#ordenarSlide').show();

//cambiamos el tipo de mouse que paraecera sobre los item
    $('#columnasSlide').css({
        'cursor': 'default'
    });

//mostramos los span de eliminar x
    $('#columnasSlide span').show();

    //mismo for que al ordenar pero esta vez se utilizara para poder enviar al controllador por ajax el update
    for (var i = 0; i < longitudElementos; i++) {

        console.log(almacenarOrdenId[i]);
        console.log(ordenItem[i]);

        //almacenamos en una varaible las varaibles que enviaramose por post Ajax
        var actualizarOrden = new FormData();
        actualizarOrden.append("actualizarOrdenSlide", almacenarOrdenId[i]);
        actualizarOrden.append("actualizarOrdenItem", ordenItem[i]);


        $.ajax({
            url: "views/ajax/gestorSlide.php", //url del archivo que recibira la peticion
            method: "POST",
            data: actualizarOrden, //varaible o informacion a enviar
            cache: false,  //limpiamos cache,
            contentType: false,
            processData: false,
            success: function (respuesta) {
                console.log("la respuesta es = " + respuesta);

                if (respuesta == 'ok') {
                    //Usaremos una alerta que nos diga que se cargo efectivamente para que recagrue la pagina
                    swal({
                            title: "!OK",
                            text: "Se actualizo el orden del Slide Correctamente !",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        },
                        function (isConfirm) {  //validamos que se halla confirmado
                            if (isConfirm) {
                                window.location = "slide";  //si se confirmo se redireccionara a slide, ya que con el .htacces solo debemos pasar el final
                            }
                        });
                }else{
                    console.log('no se pudo actualziar');
                }
            }
        })


    }


});

/*================FIN DE EDITAR  ORDENAR SLIDE============*/
