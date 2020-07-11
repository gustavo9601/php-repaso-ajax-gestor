/*
 *========================+ç
 * SUBIR VIDEOS
 * =======================
 * */

var cantidadHtml = $('#galeriaVideo li').length;
if (cantidadHtml > 0) {
    $('#galeriaVideo').css({
        'height': 'auto'
    })

} else {
    $('#galeriaVideo').css({
        'height': '100px'
    })
}


//cuando cambia el input
$('#subirVideo').on('change', function () {

    var video = '';
    video = this.files[0]; //capturo la posicion 0, ya que puedo capturar varios a la vez
    console.log(video);

    //capturo el tamaño
    var videoName = video.name;
    var videoSize = video.size;
    console.log('tamano = ', (Number(videoSize)));
    if (Number(videoSize) > 6000000) {
        $('#galeriaVideo').before('<div class="alert alert-warning alerta text-center">El archivo [' + videoName + '] Supera los 6 MB</div>');
    } else {
        /*   $('.alerta').remove(); //quitamos la alerta*/
    }
    var videoType = video.type;
    if (videoType == "video/mp4") {
        /* $('.alerta').remove();*/
    } else {
        $('#galeriaVideo').before('<div class="alert alert-warning alerta text-center">El archivo [' + videoName + '] No es Formato MP4</div>');
    }

    /*validacion final*/
    if (Number(videoSize) < 6000000 && videoType == 'video/mp4') {
        $('.alerta').remove(); //quitando la alerta
        var datos = new FormData();
        datos.append('video', video);
        $.ajax({
            url: 'views/ajax/gestorVideos.php',
            method: 'POST',
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#galeriaVideo').before('<img src="views/images/status.gif" id="status">');
            },
            success: function (respuesta) {
                $('#status').remove();
                console.log(respuesta);

                /*Rllenando con lo que traiga*/
                html = '';
                html += '<li>';
                html += '<span class="fa fa-times"></span>';
                html += '<video controls>';
                html += '<source src="' + respuesta.slice(6) + '" type="video/mp4">';
                html += '</video>';
                html += '</li>';
                $('#galeriaVideo').append(html);
                swal({
                        title: "!OK",
                        text: "Se subio el video correctamente",
                        type: "success",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    },
                    function (isConfirm) {  //validamos que se halla confirmado
                        if (isConfirm) {
                            window.location = "videos";  //si se confirmo se redireccionara a slide, ya que con el .htacces solo debemos pasar el final
                        }
                    });


            }
        });
    }

});


/*
 *
 * ELIMINACION DE VIDEO
 * */
$('.eliminarVideo').on('click', function () {
    $(this).parent().remove();


    //cambiando el tamaño si no hay mas cajas
    if ($('.eliminarVideo').length == 0) {
        $('#galeriaVideo').css({
            'height': '100px'
        })
    }

    var idVideo = $(this).parent().attr('id');//capturando el id del padre LI
    var rutaVideo = $(this).parent().attr('ruta');
    console.log("ruta video = ", rutaVideo);

    /*Peticion Ajax*/
    var borrarVideo = new FormData();
    borrarVideo.append('idVideo', idVideo);
    borrarVideo.append('rutaVideo', rutaVideo);

    $.ajax({
        url: 'views/ajax/gestorVideos.php',
        method: 'POST',
        data: borrarVideo,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta == 'ok') {
                $('.alerta').remove();
                $('#galeriaVideo').before('<div class="alert alert-success alerta text-center">El video [' + idVideo + ']se elimino correctamente</div>');
            }
        }
    });

});


/*
 *
 * ORDENANDO VIDEOS
 *
 * */
var almacenarOdenId = new Array();
var ordenItem = new Array();
$('#ordenarVideos').on('click', function () {
    $(this).hide();
    $('#guardarVideos').show();

    $('#galeriaVideo').css({'cursor': 'move'});
    $('#galeriaVideo span').hide();


    /*Accion del JQUERY UI*/
    $('#galeriaVideo').sortable({
        revert: true, //se devuelva a la poscion inicial si no se mueve totalmente
        connectWith: '.bloqueVideo',
        handle: '.handleVideo',
        stop: function (event) { //cuando suelte se ejecute


            /*Recorriendo todos lo LI que hallan*/
            for (var i = 0; i < $('#galeriaVideo li').length; i++) {
                almacenarOdenId[i] = event.target.children[i].id; //captuando el ID
                ordenItem[i] = i + 1; //amacenando la pisicion

                console.log('ID ACTUAL = ', almacenarOdenId[i]);
                console.log('orden ITEM = ', ordenItem[i]);

            }
        }
    });

});


$('#guardarVideos').on('click', function () {
    $(this).hide();
    $('#ordenarVideos').show();


    /*Recorriendo los elementos*/
    for (var i = 0; i < $('#galeriaVideo li').length; i++) {
        var actualizarOrden = new FormData();
        actualizarOrden.append('actualizarOrdenVideo', almacenarOdenId[i]);
        actualizarOrden.append('actualizarOrdenItem', ordenItem[i]);

        $.ajax({
            url: 'views/ajax/gestorVideos.php',
            method: 'POST',
            data: actualizarOrden,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {
                console.log(respuesta);
                if (respuesta != 'error') {
                    $('#galeriaVideo').html(respuesta);

                    swal({
                            title: "!OK",
                            text: "Orden actualizado ..",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        },
                        function (isConfirm) {  //validamos que se halla confirmado
                            if (isConfirm) {
                                window.location = "videos";  //si se confirmo se redireccionara a slide, ya que con el .htacces solo debemos pasar el final
                            }
                        });
                }


            }
        })

    }
});




