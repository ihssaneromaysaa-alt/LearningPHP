<?php
abstract class FiguraGeometrica{
    function __construct(protected string $nombre)
    {}
    abstract public function calcularArea();
    function mostrarNombre(){
        echo "<br>nombre: ".$this->nombre;
    }
}