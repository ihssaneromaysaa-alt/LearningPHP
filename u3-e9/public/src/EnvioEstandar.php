<?php

require_once __DIR__ . "/EnvioBase.php";
class EnvioEstandar extends EnvioBase{
    function __construct( float $peso,
                         float $distancia){
        parent::__construct($peso, $distancia,"Estandar");
    }
    function calcular_tarifa(): float{
        return 5.0 + $this->peso * 1.5 + $this->distancia * 0.05;
    }
}
