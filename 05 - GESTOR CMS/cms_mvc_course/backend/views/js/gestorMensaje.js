/*
 *
 * VALIDANDO QUE EL MENSAJE YA SE HALLA LEIDO
 *
 * */

//oprimo el boton de leer mas
$('.muestraMensajesBandejaEntrada').on('click', '.btnMensajeVisto', function () {
    var idMensajeVisto = $(this).attr('id');
    $(this).parent().remove();//quitandolo desde el padre DIV
    console.log('ID = ', idMensajeVisto);


    /*ya capturando el id visto, cambiaremos el estado del mensaje a true que es visto*/
    var datos = new FormData();
    datos.append('idMensajeVisto', idMensajeVisto);
    $.ajax({
        url: 'views/ajax/gestorMensajes.php',
        method: 'POST',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            console.log(respuesta);
        }
    });


});


/*Apartado para mostrar mensajes vistos o no*/
$('#mostrarVistosoNo').on('change', function () {
    console.log("cambio");

    var valorActual = $(this).val();
    console.log(valorActual);

    var datos = new FormData();
    datos.append('estadoMensaje', valorActual);

    $.ajax({
        url: 'views/ajax/gestorMensajes.php',
        method: 'POST',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
            var html = '';
            html += '<div class="barraProgreso progress-bar progress-bar-striped active" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">Cargando..';
            html += '</div>';

            $('.muestraMensajesBandejaEntrada').html(html);
        },
        success: function (respuesta) {
            console.log(respuesta);
            $('.muestraMensajesBandejaEntrada').html(respuesta);

        }


    });

});


/*
 *
 * APARATADO DE ENVIAR MENSAJE
 * */
$('#mostrarFormulario').on('click', function () {

    $('#mostrarEnviarMensaje').toggle(400);
});


$('#enviarResponderEmail').on('click', function () {
    //quitando las alertas
    $('.alerta').remove();

    var email = $('#emailResponderEmail').val();
    var titulo = $('#tituloResponderEmail').val();
    var mensaje = $('#mensajeResponderEmail').val();

    console.log(email, "  ", titulo, "   ", mensaje);

    var expresionValidaTexto = /^[a-zA-Z0-9\s]*$/;
    if (titulo == '' || mensaje == '') {
        $('#enviarResponderEmail').before('<div class="alert alert-danger alerta text-center">Completa todos los campos por favor</div>');
    } else if (!expresionValidaTexto.test(titulo) || !expresionValidaTexto.test(mensaje)) {
        $('#enviarResponderEmail').before('<div class="alert alert-danger alerta text-center">No se permiten caracteres especiales</div>');
    } else {

        var datos = new FormData();
        datos.append('email', email);
        datos.append('titulo', titulo);
        datos.append('mensaje', mensaje);
        //validacion de campos
        $.ajax({
            url: 'views/ajax/gestorMensajes.php',
            method: 'POST',
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                var html = '';
                html += '<div class="barraProgreso progress-bar progress-bar-striped active" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">Enviando..';
                html += '</div>';

                $('#enviarResponderEmail').before(html);
            },
            success: function (respuesta) {
                console.log(respuesta);

                $('.barraProgreso').remove();

                $('#tituloResponderEmail').val('');
                $('#mensajeResponderEmail').val('');


                swal({
                    title: "Mensaje Enviado",
                    text: "Mensaje enviado al Email: " + email,
                    type: "success",
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                });


            }
        });


    }
});


/*EJECUCION AUTOMATICA PARA VALIDAR , si hay mas mensajes en la BD*/
setInterval(function () {
    var datos = new FormData();
    datos.append('activa', '1');
    $.ajax({
        url: 'views/ajax/gestorMensajes.php',
        method: 'POST',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            $('#cantidadMensajes').html(respuesta);
            $('#cantidadSuscriptores').html(respuesta);

        }
    })


}, 3000);


