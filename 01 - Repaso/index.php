<?php

print 'PRINT solo permite impirmir un resultado';

echo '<br> ECHO Permite imprimir varios resultados <br>';


$varaibelObjeto = (object)[
    "objeto1" => "Gustavo",
    "objeto2" => "Marquez"
];

/*los objeto se invocaion asi :
ombreObjeto -> suvalor*/
echo "El valor ombre de la varaible Ojeto es = $varaibelObjeto->objeto1 $varaibelObjeto->objeto2";



/*Funcones*/
function colegio(){
    echo "<br>  Funcion 1 </br>";
}

colegio();

function colegio2($estudiante){
    echo "<br>El estudiante es :  $estudiante</br>";
}

colegio2("Gustavo");

function colegio3($apellido){
    return $apellido;
}

echo "<br> El apegllido es = " . colegio3('marquez') . "</br>";

?>


