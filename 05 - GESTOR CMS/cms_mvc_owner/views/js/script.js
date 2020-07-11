/*=============================================
 SLIDE
 =============================================*/
var numeroSlide = 1;
var formatearLoop = false;
var cantidadImg = $("#slide ul li").length;


//for que agragara de acuerdo ala cantidad de imagen indicadores
for (var i = 0; i < cantidadImg; i++) {
    $('#indicadores').append(
        '<li role-slide="' + (i + 1) + '"><span class="fa fa-circle"></span></li>'
    );
}


$("#slide ul").css({"width": (cantidadImg * 100) + "%"})
$("#slide ul li").css({"width": (100 / cantidadImg) + "%"})

/* INDICADORES */

$("#indicadores li").click(function () {

    var roleSlide = $(this).attr("role-slide");

    $("#slide ul li").css({"display": "none"});

    $("#slide ul li:nth-child(" + roleSlide + ")").fadeIn();

    $("#indicadores li").css({"opacity": ".5"});

    $("#indicadores li:nth-child(" + roleSlide + ")").css({"opacity": "1"});

    formatearLoop = true;

    numeroSlide = roleSlide;

})

/* FLECHA AVANZAR */

function avanzar() {

    if (numeroSlide >= cantidadImg) {
        numeroSlide = 1;
    }

    else {
        numeroSlide++
    }

    $("#slide ul li").css({"display": "none"});

    $("#slide ul li:nth-child(" + numeroSlide + ")").fadeIn();

    $("#indicadores li").css({"opacity": ".5"});

    $("#indicadores li:nth-child(" + numeroSlide + ")").css({"opacity": "1"});
}


$("#slideDer").click(function () {

    avanzar();

    formatearLoop = true;

})

/* FLECHA RETROCEDER */

$("#slideIzq").click(function () {

    if (numeroSlide <= 1) {
        numeroSlide = cantidadImg;
    }

    else {
        numeroSlide--
    }


    $("#slide ul li").css({"display": "none"});

    $("#slide ul li:nth-child(" + numeroSlide + ")").fadeIn();

    $("#indicadores li").css({"opacity": ".5"});

    $("#indicadores li:nth-child(" + numeroSlide + ")").css({"opacity": "1"});

    formatearLoop = true;

})

/* LOOP */

setInterval(function () {

    if (formatearLoop == true) {

        formatearLoop = false;
    }

    else {

        avanzar();

    }

}, 5000);

/*=====  Fin de SLIDE  ======*/

/*=============================================
 GALERÍA
 =============================================*/

$("#galeria ul li a").fancybox({

    openEffect: 'elastic',
    closeEffect: 'elastic',
    openSpeed: 150,
    closeSpeed: 150,
    helpers: {title: {type: 'inside'}}

});

/*=====  Fin de GALERÍA   ======*/

/*=============================================
 SCROLL
 =============================================*/

$("nav#botonera ul li a").click(function (e) {

    e.preventDefault();

    var href = $(this).attr("href");

    $(href).animatescroll({

        scrollSpeed: 2000,
        easing: "easeOutBounce"

    });

});

$.scrollUp({

    scrollText: "",
    scrollSpeed: 1500,
    easingType: "easeOutBounce"

});

/*=====  Fin de SCROLL   ======*/



/* ==========================================
 * CONTACTO, ENVIO DE MENSAJE
 * =========================================*/
$('#enviarContacto').on('click', function () {
    $('.alerta').remove();
//	captura de valores
    var nombreContacto = $('#nombreContacto').val();
    var emailContacto = $('#emailContacto').val();
    var comentarioContacto = $('#comentarioContacto').val();

    var expresionValidaTexto = /^[a-zA-Z0-9\s]*$/;
    var expresionValidaCorreo = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if (nombreContacto == '' || emailContacto == '' || comentarioContacto == '') {

        $('#formulario').prepend('<div class="alert alert-danger alerta text-center">Completa todos los campos por favor</div>');
    } else if (!expresionValidaTexto.test(nombreContacto) || !expresionValidaTexto.test(comentarioContacto)) {
        $('#formulario').prepend('<div class="alert alert-danger alerta text-center">No se permiten caracteres especiales</div>');
    } else if (!expresionValidaCorreo.test(emailContacto)) {
        $('#formulario').prepend('<div class="alert alert-danger alerta text-center">Email incorrecto, intenta de nuevos</div>');
    } else {
        /*envaidno el mensaje va ajax*/
        var datos = new FormData();
        datos.append('nombre', nombreContacto);
        datos.append('email', emailContacto);
        datos.append('comentario', comentarioContacto);

        $.ajax({
            url: 'controllers/gestorContacto.php',
            method: 'POST',
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                var html = '';
                html += '<div class="barraProgreso progress-bar progress-bar-striped active" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">Enviando..';
                html += '</div>';
                $('#formulario').append(html);
            },
            success: function (respuesta) {
                console.log(respuesta);


                if (respuesta == 'okok') {
                    $('.barraProgreso').remove();
                    swal({
                        title: "Mensaje Enviado",
                        text: "Uno de nuestros asesores, se pondra en contacto contigo ",
                        type: "success",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });

                    var nombreContacto = $('#nombreContacto').val('');
                    var emailContacto = $('#emailContacto').val('');
                    var comentarioContacto = $('#comentarioContacto').val('');

                }

            }
        });
    }


});