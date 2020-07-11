<?php

/*
 *
 * CLASE -> modelo que se utiliza p
 * para crear objetos que comparte un mismo comportamiento
 * un mismo estado e identidad
 * */


class Automovil{
    /*
     * PROPIEDADES -> Caracteristicas que puede tener un objeto
     *
     * */

    public $marca;
    public $modelo;

/*
 *
 * METODO -> Algoritmo aociado  a un objeto ,  que cumple una funcion
 * manipulabdo las propuedades
 *
 * Metodo llamamos a las funcion en POO
 * */

    public function mostrar(){
        /*Con this siempre apuntamos a los datos de la intancia que eherede la clase*/
        echo "<p>Hola soy un $this->marca, y mi modelo es $this->modelo</p>";
    }

}

/*Objeto -> Entidad porvista de metodos o mensajes a los cuales
resonden porpiedades con valores
*/

$carro1 = new Automovil();
//sobrescribiendo las fvariable publicas
$carro1 -> marca = "Totyota";
$carro1 -> modelo = "FURTUNER";
$carro1->mostrar();//invocamo sla funcion


$caroo2 = new Automovil();
$caroo2 -> marca = 'BMW';
$caroo2 -> modelo = 'XS 3';
$caroo2 -> mostrar();
?>