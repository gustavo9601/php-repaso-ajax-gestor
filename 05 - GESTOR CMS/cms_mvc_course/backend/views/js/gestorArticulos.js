/*============================*/
//Funcion que permite Ordenar los Articulos

var almacenarOrdenId = new Array();
var ordenItem = new Array();
$('#ordenarArticulos').click(function () {
    //Escondiedo y apareciendo el boton guardar o ordenar
    $('#ordenarArticulos').hide();
    $('#guardarOrdenArticulos').show();


    $('#editarArticulo').css({'cursor': 'move'});  //cambia el cursor
    $('#editarArticulo span i').hide();  //escondemos los bootnes de eliminar y editar
    $('#editarArticulo button').hide();
    $('#editarArticulo hr').hide();
    $('#editarArticulo span').css({'position': 'absolute', 'top': '10px', 'right': '15px'});
    $('#editarArticulo img').css({'margin-bottom': '20px'});
    $('#editarArticulo li').css({'margin-bottom': '30px'});
    $('#editarArticulo div').remove();  //eliminado los modales 
    $('#editarArticulo li').css({'padding': '0px 20px'});
    $('#editarArticulo li span').html('<i class="glyphicon glyphicon-move" style="padding:8px"></i>');

    $('#editarArticulo li').css({'border': '1px dashed #000'});

//    $('#editarArticulo li').mouseleave(function () {
//        $(this).css({'background': '#fff'});
//    });

//subiendo el scrooll a la parte superior
    $('body', 'html').animate({
        scrollTop: $('body').offset().top
    }, 500); //se demora 1/2seg


//aplicando sortable de JQUERYUI
    $('#editarArticulo').sortable({
        revert: true, //en caso de mover un poquito volvera a su estado normal
        connecWith: ".bloqueArticulo", //hacia que elementos hijos se realiza el enlace, para este caso a los li de calse bloqueArticulo
        stop: function (event) {  //cuando termina de mover los elemntos
            //recorremos la cantidad de elemetos li que existan
            for (var i = 0; i < $('#editarArticulo li').length; i++) {
                almacenarOrdenId[i] = event.target.children[i].id;   //almaceno el id del item
                ordenItem[i] = i + 1;   //captura el orden los item 
            }
        }
    });

//mostrando de nuevo el boton y apareciendo el otro
    $('#guardarOrdenArticulos').click(function () {
        $('#ordenarArticulos').show();
        $('#guardarOrdenArticulos').hide();

        //mostrando por consola el resultado de lo que hay en los li, mostrando el id
        for (var i = 0; i < $('#editarArticulo li').length; i++) {
            console.log("ID = " + almacenarOrdenId[i] + " Esta en la posicion = " + ordenItem[i]);

            //creando la peticion ajax, que actualizara uno a uno el id con la nueva posicion
            var actualizarOrden = new FormData();
            actualizarOrden.append('actualizarOrdenArticulos', ordenItem[i]);  //poscion
            actualizarOrden.append('actualizarOrdenItem', almacenarOrdenId[i]);//id

            $.ajax({
                url: "views/ajax/gestorArticulos.php",
                method: 'POST',
                data: actualizarOrden,
                cache: false,
                contentType: false,
                processData: false,
                success: function (respuesta) {

                    console.log(respuesta);
                    if (respuesta == 'error') {
                        html = '';
                        html += '<div class="alert alert-danger" role="alert">';
                        html += '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
                        html += '<span class="sr-only">Error:</span>';
                        html += 'No se pudo actualizar';
                        html += '</div>';

                        $('#editarArticulo').html(html);  //reemplazo el html deñ UL por lo que me devuevla php
                    } else {
                        $('#editarArticulo').html(respuesta);
                        swal({
                                title: "!OK",
                                text: "Se actualizo el orden de articulos",
                                type: "success",
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            },
                            function (isConfirm) {  //validamos que se halla confirmado
                                if (isConfirm) {
                                    window.location = "articulos";  //si se confirmo se redireccionara a slide, ya que con el .htacces solo debemos pasar el final
                                }
                            });
                    }
                }
            });

        }

    });

});


/*============================*/
//funcion que agrega ela rticulo
$('#btnAgregarArticulo').on('click', function () {
    //la mostrara con el efecto toggle, ya que inicia desaperecido
    $('#agregarArtículo').toggle(400);

});

/*============================*/


/*============================*/
//funcion que recibe cuando el input file esta lleno y muestra la iamgen y hace la perticion ajax


//detecta cuando cambie el inpt
$('#subirFoto').on('change', function () {
    //capturo en una vaariable las caracteristicas del archivo subido en el input file
    imagen = "";
    imagen = this.files[0];
    console.log(imagen);

    //validar tamaño de la imagen
    imagenSize = imagen.size;

    if (Number(imagenSize) > 2000000) {
        $('#arrastreImagenArticulo').before(
            '<div class="alerta alert alert-warning" style="text-align: center">La imagen execede el peso establecido de 2MB</div>'
        );
    } else {
        //quitamos la alerta de pasar el filtro
        $('.alerta').remove();
    }

    //validar el tipo de imagen
    imagenType = imagen.type;
    if (imagenType == 'image/jpeg' || imagenType == 'image/png') {
        //quitamos la alerta de pasar el filtro
        $('.alerta').remove();
    } else {
        $('#arrastreImagenArticulo').before(
            '<div class="alerta alert alert-warning" style="text-align: center">Debe ser archivo JPG o PNG</div>'
        );
    }


    //Mostrar imagen con Ajax
    if (Number(imagenSize) < 2000000 && imagenType == 'image/jpeg' || imagenType == 'image/png') {

        var datos = new FormData();
        datos.append('imagen', imagen);
        $.ajax({
            url: "views/ajax/gestorArticulos.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () { //antes que se cargue el ajax
                $('#arrastreImagenArticulo').before('<img src="views/images/status.gif" id="status" >');
            },
            success: function (respuesta) {
                console.log(respuesta);

                $('#status').remove();//quitando la imagrn decirucolo

                if (respuesta == 0) {
                    $('#arrastreImagenArticulo').before(
                        '<div class="alerta alert alert-warning" style="text-align: center">La imagen no cumple con las medidas</div>'
                    );
                } else {
                    //que aparesca la imagen, y con slice le quitamos los primero 6 caraceresrs
                    $('#arrastreImagenArticulo').html(
                        '<div id="imagenArticulo"><img src="' + respuesta.slice(6) + '" class="img-thumbnail"></div>'
                    );
                }
            }


        });
    }


});


//EDITAR ARTICULO

//captuamos el vevnto click sobre el icnco con la clase de editar
$('.editarArticulo').on('click', function () {

    //capturo el id del padre del boton
    var idArticulo = $(this).parent().parent().attr("id");
    console.log(idArticulo);

    //capturo la ruta de la iamgen, seleccionado al li padre, luego a su hijo img le saco el atributo src
    var rutaImagen = $("#" + idArticulo).children("img").attr("src");
    console.log(rutaImagen);

    //capturo el tidulo, lo que contenga en el html
    var titulo = $("#" + idArticulo).children("h1").html();
    console.log(titulo);
    //capturo la intrudccion, lo que contenga en el html
    var introduccion = $("#" + idArticulo).children("p").html();
    console.log(introduccion);
    //capturamos el valor del input hidden oculto
    var contenido = $("#" + idArticulo).children("input").val();


    //cuando se capturen los datos, ahora generearemos un appen en forma de forumlario
    var html = "";
    html += '<form method="post" enctype="multipart/form-data">';
    html += '<input class="btn btn-primary pull-right" type="submit" value="Guardar" style="width:10% ; padding: 5px 0;">';
    html += '</span>';
    html += '<div id="editarImagen">';
    html += '<input type="file" class="btn btn-default" id="subirNuevaFoto" style="display: none;">'; //input que inicialmente se crea invisible
    html += '<div id="nuevaFoto"><span class="fa fa-times cambiarImagen"></span><img src="' + rutaImagen + '" class="img-thumbnail"></div>';
    html += '</div>';
    html += '<input type="text" value="' + titulo + '" name="editarTitulo">';
    html += '<textarea cols="30" rows="5" name="editarIntroduccion">' + introduccion + '</textarea>';
    html += '<textarea name="editarContenido" id="editarContenido" cols="30" rows="10" >' + contenido + '</textarea>';
    html += '<input type="hidden" name="id" value="' + idArticulo + '">'; //input escondido que lleva el id
    html += '<input type="hidden" name="fotoAntigua" value="' + rutaImagen + '">'; //input escondido que lleva la ruta de la iamgen actual, para luago
    //desde el php hacer la comparacion si se cambio o no la iamgen actual
    html += '</form>';

    //añaidiendo la varaible html
    $("#" + idArticulo).html(html);


    //validano cuando se de x sobre la imagen para cambiarla
    $('.cambiarImagen').on('click', function () {
        //oculto el elemento
        $(this).hide();

        //visualizamos el input de tipo file
        $('#subirNuevaFoto').show();
        $('#subirNuevaFoto').css({
            "width": "90%"
        });
        //quitamos la imagen que ya estaba la dejamos vacia
        $('#nuevaFoto').html("");


        $('#subirNuevaFoto').attr('name', 'editarImagen');  //cuando se cambie el esta del input file, con esto le agregamos nombre a ese input
        $('#subirNuevaFoto').attr('required', true);  //hacemos que sea requerido cargar una imagen para poder enviar el formulario

        //capturando el cambio de estado al subir la nueva iamgen
        $('#subirNuevaFoto').on('change', function () {

            //capturamos la imagen en la varaible
            var imagen = this.files[0];
            var imagenSize = imagen.size;  //capturando el peso del archivo
            var imagenType = imagen.type;  //capturando el tipo de imagen

            //si no cuenta con el peso requerdio, mostramos una alerta
            if (Number(imagenSize) > 2000000) {
                $('#editarImagen').before(
                    '<div class="alerta alert alert-warning" style="text-align: center">La imagen execede el peso establecido de 2MB</div>'
                );
            } else {
                //quitamos la alerta de pasar el filtro
                $('.alerta').remove();
            }


            //condicional de tipo de imagen
            if (imagenType == "image/jpeg" || imagenType == "image/png") {
                //quitamos la alerta de pasar el filtro
                $('.alerta').remove();
            } else {
                $('#editarImagen').before(
                    '<div class="alerta alert alert-warning" style="text-align: center">No es una imagen admitida</div>'
                );
            }


            //validamos si los dos condicionales se cumplen
            if (imagenType == "image/jpeg" || imagenType == "image/png" && Number(imagenSize) < 2000000) {

                //si se cumple realizamos la peticion ajax
                // creamos la varaible que enviaremos al servidor

                var datos = new FormData();
                datos.append("imagen", imagen); //pasamos la imagen

                //peticion ajax
                $.ajax({
                    url: "views/ajax/gestorArticulos.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () { //antes que se cargue el ajax
                        $('#nuevaFoto').html('<img src="views/images/status.gif" id="status2" style="width:25%">');
                    },
                    success: function (respuesta) {
                        console.log(respuesta);

                        $('#status2').remove();//quitando la imagrn decirucolo

                        if (respuesta == 0) {
                            $('#arrastreImagenArticulo').before(
                                '<div class="alerta alert alert-warning" style="text-align: center">La imagen no cumple con las medidas</div>'
                            );
                        } else {
                            //aparecemos la nueva imagen con la url que nos devuelva la respuesta del ajax
                            $('#nuevaFoto').html(
                                '<img src="' + respuesta.slice(6) + '" class="img-thumbnail">'
                            );


                        }
                    }


                });
            }


        });

    });


});


/*============================*/
/*============================*/


/*============================*/
