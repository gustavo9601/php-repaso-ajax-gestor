/*
 * VALIDAR USUARIO EXISTENTE CON AJAX Y JQUERY
 * */

//varaibles que devoleran si existe o no y de esta forma no dejara enviar el formulario a la BD
var usuarioExiste = false;
var emailExiste = false;


//escuhamos el evento de cambio en e input se ejcutara la funcion
$('#usuarioRegistro').change(function () {

    var usuario = $('#usuarioRegistro').val();
    //console.log(usuario);
    var datos = new FormData(); //dato de formulario propio para ajax
    datos.append("validarUsuario", usuario);  // nombreVariable, valor

    $.ajax({
        url: "views/modules/ajax.php",   //url de archivo al cual se envuara la peticion
        method: "POST",  //metodo de envio
        data: datos,  //pasamos lo que se va a buscar, en lav arible de arriab
        cache: false,   //le decimos q no alamcene datos en cache
        contentType: false,   //tipo de ocntenido falso
        processData: false,
        success: function (respuesta) { //le pasamos una funcion , para que se ejcute cuando se efcto la petuciona ajax
            console.log(respuesta);  //esto es lo que finalemnte se va a ver el usuario

//puede ser 0 O 1 de acuerdoa ello se debera mostrar o no si ya existe
            if (respuesta == 0) {
                //cambiamos el estado de la varaible
                usuarioExiste = true;

                //agrega,os al lebel span lo que se muestra
                $("label[for='usuarioRegistro'] span#mostrarError")
                    .html("El usuario ya Existe por favor itente con otro");
            } else {
                usuarioExiste = false;

                //modificamos de neuvo solo el label pero lo dejamo en limpio
                $("label[for='usuarioRegistro'] span#mostrarError")
                    .html("");

            }

        }
    });

});

//validaicon de email si ya existe
//escuhamos el evento de cambio en e input se ejcutara la funcion
$('#emailRegistro').change(function () {

    var email = $('#emailRegistro').val();
    //console.log(email);
    var datos = new FormData(); //dato de formulario propio para ajax
    datos.append("validarEmail", email);  // nombreVariable, valor

    $.ajax({
        url: "views/modules/ajax.php",   //url de archivo al cual se envuara la peticion
        method: "POST",  //metodo de envio
        data: datos,  //pasamos lo que se va a buscar, en lav arible de arriab
        cache: false,   //le decimos q no alamcene datos en cache
        contentType: false,   //tipo de ocntenido falso
        processData: false,
        success: function (respuesta) { //le pasamos una funcion , para que se ejcute cuando se efcto la petuciona ajax
            console.log(respuesta);  //esto es lo que finalemnte se va a ver el usuario

//puede ser 0 O 1 de acuerdoa ello se debera mostrar o no si ya existe
            if (respuesta == 0) {
                emailExiste = true;

                //agrega,os al lebel span lo que se muestra
                $("label[for='emailRegistro'] span#mostrarError")
                    .html("El correo ya esta en uso por favor intente con otro");
            } else {
                emailExiste = false;

                //modificamos de neuvo solo el label pero lo dejamo en limpio
                $("label[for='emailRegistro'] span#mostrarError")
                    .html("");
            }
        }
    });
});


//FIN DE VALIDAR USUARIO CON AJAX

/*
 * VALIDAR REGISTRO
 * */

function validarRegistro() {

    //capturando el valor de los input en variable
    var usuario = document.querySelector("#usuarioRegistro").value;
    var password = document.querySelector("#passwordRegistro").value;
    var email = document.querySelector("#emailRegistro").value;
    //capturamos si esta chekeado el input tipo checkbox
    var terminosCheckbox = document.querySelector('#terminos').checked;
    /* console.log(usuario);
     console.log(password);
     console.log(email);*/

    //validar usuarios
    if (usuario != "") {
        //.lengt -> cantidad de caracteres
        var caracteres = usuario.length;
        var expresionRegular = /^[a-zA-Z0-9]*$/; //exprecion que valida a-z y snumeros
        if (caracteres > 6) {
            //seleccionamos el label de for usuarioRegistro
            //añadimos a lo que contenga, el texto mas el salto de linea
            document.querySelector("label[for='usuarioRegistro']")
                .innerHTML += "<br>Por favor menos de 6 Caracteres</br>";

            return false;
        }


        //usamos la variable con la expresion, y usando la funcion test validarmos la varaible usuario
        if (!expresionRegular.test(usuario)) {
            document.querySelector("label[for='usuarioRegistro']")
                .innerHTML += "<br>No escriba caracteres especiales</br>";
            return false;
        }

    }


    /*Validacion de checkbox*/
    //se valida que si viene en falsemuestre el mensaje
    if (!terminosCheckbox) {
        //mostramos debajo del furmlario el error
        document.querySelector("form#formulario")
            .innerHTML += "<br>Acepte terminos y condiciones</br>";

        //capturamos lo que contenga los input para que el usuario no tenga que volverlo a escribirs
        document.querySelector("#usuarioRegistro").value = usuario;
        document.querySelector("#passwordRegistro").value = password;
        document.querySelector("#emailRegistro").value = email;


        return false;
    }



    //nos ayudamos de las varaibles globales controlado si se genero error de existencia o no
    if(usuarioExiste == true || emailExiste == true){
        //retornamos falso para que no deje enviar el formulario
        return false;
    }

    return true;
}


//FIN VALIDAR REGISTRO