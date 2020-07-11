<?php
/*
  *
  * Codigo imperativo o Espahuetti
 *
  * */

$automovil1 = (object)[
    "marca" => "Toyota",
    "modelo" => "Corona III"
];

$automovil2 = (object)[
    "marca" => "BMW",
    "modelo" => "x3"

];


function mostrar($automovil){
echo "<h1> Hola soy un $automovil->marca
 y mi modelos es = $automovil->modelo</h1>";
}
//invocando la funcion y pasando por paraemtro los objetos
mostrar($automovil1);

mostrar($automovil2);

?>