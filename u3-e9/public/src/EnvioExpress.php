<?php

require_once __DIR__ . "/EnvioBase.php";
class EnvioExpress extends EnvioBase{
    function __construct( float $peso,
                         float $distancia){
        parent::__construct($peso, $distancia,"Express");
    }
    function calcular_tarifa(): float{
        return new EnvioEstandar($this->peso,  $this->distancia)->calcular_tarifa() + 10.0;
    }
    
}