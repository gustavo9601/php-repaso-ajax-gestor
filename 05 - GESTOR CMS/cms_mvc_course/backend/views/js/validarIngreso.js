function validarIngreso() {

    var expresion = '/^[a-zA-Z0-9]*$/';
//captura de valores de los iput
    var usuario = $('#usuarioIngreso').val();
    var password = $('#passwordIngreso').val();
    var divError = $('#alertaError');
    console.log(divError);
//hacinado el testeo de la varaible regula sobre lo que traiga por valor el input
    if (!expresion.test(usuario)) {
        return false;
    }

    if (!expresion.test(password)) {
        return false;
    }


//si escribe lo datos correctos re tronara true
    return true;
}