/*Detectando evento de click sobre eliminar*/
$('.quitarSuscriptor').on('click', function () {

    var padreTr = $(this).parent().parent();
    var nombrePadre = padreTr.attr('nombre');
    var idActualizar = padreTr.attr('id');
    swal({
            title: "Estas seguro ?",
            text: "De eliminar al suscriptor " + nombrePadre + " ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: 'No !',
            confirmButtonText: "Si eliminar!",
            closeOnConfirm: false
        },
        function () {
            //quitando la fila
            padreTr.remove();
            var datos = new FormData();
            datos.append('idActualizar', idActualizar);
            //ejecutar update de estado inactivo
            $.ajax({
                url: 'views/ajax/gestorContacto.php',
                method: 'POST',
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function (respuesta) {
                    console.log(respuesta);
                    swal("Suscriptor Eliminado", "", "success");
                }
            })


        });


});

/*$('.botonImprimePDF').on('click',function(){
 sweetAlert("Oops...", "En el momento esta opcion se ecnuentra en construccion!", "error");
 })*/


/*HORA Y FECHA ACTUAL*/
var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
var diasSemana = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
var f = new Date();
$('.fechaActual').html(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());

$('.horaActual').html(f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds());
