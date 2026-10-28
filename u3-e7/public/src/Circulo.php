<?php
require_once __DIR__ . '/FiguraGeometrica.php';
class Circulo extends FiguraGeometrica{
    function __construct(private float $radio,
    string $nombre="circulo"){
        parent::__construct($nombre);
    }
    public function calcularArea(){
        return 3.14*(($this->radio)**2);
    }
}