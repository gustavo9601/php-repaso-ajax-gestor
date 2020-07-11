/*
 * ARRASTRE DE IMAGENES
 *
 *
 * */

if ($('#lightbox li').length == 0) {
    $('#lightbox').css({
        'height': '100px'
    });
} else {
    $('#lightbox').css({
        'height': 'auto'
    });
}


/*
 *
 * SUBIR MULTIPLES IMAGENES
 * */


//DETECTANDO EL EVENTO AL SOLTAR UNA IMAGEN SOBRE EL CONTENEDOR UL
$('#lightbox').on('dragover', function (e) {

    //quitamos lo eventos por defecto
    e.preventDefault();
    e.stopPropagation();

    //vacio las alertas en cada disparo de evento
    $('.alerta').remove();

    $(this).css({
        'background': 'url(views/images/pattern.jpg)'
    });

});

//DETENCTANDO CUANDO SE SUELTA LA IMAGENes


$('#lightbox').on('drop', function (e) {
    var imagenSize = [];
    var imagenType = [];
    var imagenName = [];

    e.preventDefault();
    e.stopPropagation();

    $(this).css({
        'background': 'white'
    });

    //capturando el archivo que se solto sobre esta area
    var archivo = e.originalEvent.dataTransfer.files;
    console.log("Imagen = ", archivo);

    //recorriendo todas las imagenes subidas
    for (var i = 0; i < archivo.length; i++) {
        imagen = archivo[i]; // capturando uno a uno la imagen
        imagenSize.push(imagen.size);  //capturando el tamaño de cada imagen
        imagenType.push(imagen.type); //capturando el tipo de imagen
        imagenName.push(imagen.name); //capturo el nombre


        console.log('Imagen ', i, ' Tamaño = ', imagenSize[i], ' Tipo = ', imagenType[i], ' Nombre = ', imagenName[i]);


        //validacion de tamaño, y casteo del dato a numerico
        if (Number(imagenSize[i]) > 2000000) {
            //before, exactamente antes de esta etiqueta, coloco la alerta por cada imagen que rompa las reglas
            $(this).before('<div class="alert alert-warning alerta text-center">El archivo ' + imagenName[i] + ' excede el peso de 2 MB</div>');

        } else {
            /*$('.alerta').remove(); */ //removemos la alerta
        }

        //validacion de Tipo de imagen
        if (imagenType[i] == 'image/jpeg' || imagenType[i] == 'image/png') {
            /*$('.alerta').remove();*/
        } else {
            $(this).before('<div class="alert alert-warning alerta text-center">El archivo ' + imagenName[i] + ' No es una imagen</div>');
        }


        /*Validacion final para enviar al server*/
        if (Number(imagenSize[i]) < 2000000 && imagenType[i] == "image/jpeg" || imagenType[i] == "image/png") {

            var datos = new FormData();
            datos.append("imagen", imagen);  //Enviamos todas las imagenes a Ajax

            $.ajax({
                url: "views/ajax/gestorGaleria.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    //dentro del UL, hago que aparesca el append
                    $('#lightbox').append('<li id="status"><img src="views/images/status.gif"></li>')
                },
                success: function (respuesta) {
                    $('#status').remove();  //remuevo el loader

                    console.log(respuesta);

                    if (respuesta == 'error' || respuesta == 'fallo') {
                        $('#lightbox').before('<div class="alert alert-warning alerta text-center">La imagen no cumple con las medidas necesarias</div>');
                    } else {

                        var imagenProvisional = '';
                        imagenProvisional = respuesta.slice(6);
                        var html = '';
                        html += '<li>';
                        html += '<span class="fa fa-times"></span>';
                        html += '<a rel="grupo" href="' + imagenProvisional + '">';
                        html += '<img src="' + imagenProvisional + '">';
                        html += '</a>';
                        html += '</li>';

                        $('#lightbox').append(html);
                        $('#lightbox').css({
                            'height': 'auto'
                        });


                        /*Alerta suave*/
                        swal({
                                title: "!OK",
                                text: "La imagen se subio Correctamente !",
                                type: "success",
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            },
                            function (isConfirm) {  //validamos que se halla confirmado
                                if (isConfirm) {
                                    window.location = "galeria";  //si se confirmo se redireccionara a slide, ya que con el .htacces solo debemos pasar el final
                                }
                            });

                    }


                }
            });

        }


    }


});


/*
 *
 * eliminar ITEM DE GALERIA
 * */

//cuando de click sobre alguna de las imagenes que tienen esta clase
$('.eliminarFoto').on('click', function () {

    var idGaleria = '';
    idGaleria = $(this).parent().attr('id');  //capturo el id del li padre
    rutaImagen = $(this).attr('ruta'); //alamncena toda la ruta completa, de un atributo inventado sobre el span
    console.log("ID A ELIMINAR = ", idGaleria);

    //elimiando todo el li
    $(this).parent().remove();

    /*Peticion ajax para borrarlo del server y de la BD*/
    var borrarItem = new FormData();
    borrarItem.append('idGaleria', idGaleria);
    borrarItem.append('rutaGaleria', rutaImagen);

    $.ajax({
        url: 'views/ajax/gestorGaleria.php',
        method: 'POST',
        data: borrarItem,
        cache: false,
        contentType: false,
        processData: false,
        success: function (repuesta) {

            console.log(repuesta);

            $('.alerta').remove();
            $('#lightbox').before('<div class="alert alert-success alerta text-center">La imagen No - [' + idGaleria + '] se elimino correctamente</div>');
        }

    });

});


/*
 *
 * ORDENANDO LOS ITEM DE LA GALERIA
 *
 * */
//ordenar
var almacenarOrdenId = new Array();
var ordenItem = new Array();
$('#ordenarGaleria').on('click', function () {
    $('#ordenarGaleria').hide();
    $('#guardarGaleria').show();

    $('#lightbox').css({"cursor": "move"});
    $('#lightbox span').hide();

    //funcion de jquery
    $('#lightbox').sortable({
        revert: true, //que se devuelva si no la movemos bien
        connectWith: ".bloqueGaleria",  //clase de coneccion de movimineto
        handle: ".handleImage", //clase desde la cual sale la manito a mover
        stop: function (event) {

            //recorrera todos los li que se contengan
            for (var i = 0; i < $('#lightbox li').length; i++) {
                almacenarOrdenId[i] = event.target.children[i].id;  //Capturo el orden establecido a ese li despues del movimiento
                ordenItem[i] = i + 1; //orden del item
            }
        }
    });

});


//guardar
$('#guardarGaleria').on('click', function () {
    $('#guardarGaleria').hide();
    $('#ordenarGaleria').show();

    //peticion hacia ajax
    for (var i = 0; i < $('#lightbox li').length; i++) {
        var actualizarOrden = new FormData();
        actualizarOrden.append('actualizarOrdenGaleria', almacenarOrdenId[i]);
        actualizarOrden.append('actualizarOrdenItem', ordenItem[i]);

        console.log('Id en galeria', almacenarOrdenId[i]);
        console.log('Orden en galeria', ordenItem[i]);

        $.ajax({
            url: 'views/ajax/gestorGaleria.php',
            method: "POST",
            data: actualizarOrden,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {
                console.log(respuesta);
                if (respuesta == 'error') {
                    $('#lightbox').before('<div class="alert alert-success alerta text-center">Error: No fue posible actualizar el orden</div>');
                } else {


                    $('#lightbox').html(respuesta);

                    swal({
                            title: "!OK",
                            text: "Se ordenaron Correctamente las imagenes",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        },
                        function (isConfirm) {  //validamos que se halla confirmado
                            if (isConfirm) {
                                window.location = "galeria";  //si se confirmo se redireccionara a slide, ya que con el .htacces solo debemos pasar el final
                            }
                        });
                }


            }
        });
    }
});

