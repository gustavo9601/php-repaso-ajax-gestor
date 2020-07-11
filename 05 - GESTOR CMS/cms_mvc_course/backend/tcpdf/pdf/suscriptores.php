<?php
/*
 * medida de un pdf en PX
 * width: 500px;
 * height:
 *
 * // Lo recomendado es maquetar en Tablas
 *
 * */


//Importando el controller
require_once "../../controllers/gestorSuscriptores.php";
//importando el modelo de BD
require_once "../../models/gestorSuscriptores.php";

class ImpresionSuscriptores{

public function imprimirSuscriptores(){

require_once('tcpdf_include.php'); //incluimosel archivo de confiuracion de tcpdf
//cremoas documento pdf
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//adicionamos una pagina pdf
$pdf->AddPage();

$html1 = <<<EOF
	
	<table>
		<tr>
			<td style="width:540px"><img src="images/back.jpg"></td>
		</tr>

		<tr>
			<td width="200px"></td>
			<td style="width:140px"><img src="images/logotipo.jpg"></td>
			<td width="200px"></td>
		</tr>
	</table>

	<table style="border: 1px solid #333; text-align:center; line-height: 20px; font-size:10px">
		<tr>
			<td style="border: 1px solid #666; background-color:#333; color:#fff">Nombre</td>
			<td style="border: 1px solid #666; background-color:#333; color:#fff">Email</td>
		</tr>
	</table>

EOF;

//pasamos a la funcion lo que va a escribir en html
$pdf->writeHTML($html1, false, false, false, false, ''); 

//llamando la clase, del controllador para que me devuelva el query
$respuesta = @SuscriptoresController::impresionSuscriptoresController("suscriptores");

//rellenado la tabla con la informacion
foreach ($respuesta as $row => $item) {

$html2 = <<<EOF

	<table style="border: 1px solid #333; text-align:center; line-height: 20px; font-size:10px">
		<tr>
			<td style="border: 1px solid #666;">$item[nombre]</td>
			<td style="border: 1px solid #666;">$item[email]</td>
		</tr>
	</table>

EOF;
//escribo mas html sobre el documento
$pdf->writeHTML($html2, false, false, false, false, ''); 	

}

//nombre del archivo
$pdf->Output('suscriptores.pdf');

}

}

//llamando y creando un objeto de la clase actual
$a = new ImpresionSuscriptores();
//ejecutnado la funcion de la clase
$a -> imprimirSuscriptores();

?>