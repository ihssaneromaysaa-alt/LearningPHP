<?php
require_once __DIR__ . '/FiguraGeometrica.php';
class Rectangulo extends FiguraGeometrica{
    function __construct(private float $ancho,
    private float $alto,
    string $nombre="rectangulo"){
        parent::__construct($nombre);
    }
    public function calcularArea(){
        return 2*(($this->alto)+($this->ancho));
    }
}