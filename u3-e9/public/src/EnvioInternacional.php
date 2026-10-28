<?php

require_once __DIR__ . "/EnvioBase.php";
class EnvioInternacional extends EnvioBase{
    function __construct( float $peso,
                         float $distancia){
        parent::__construct($peso, $distancia,"Internacional");
    }function calcular_tarifa(): float{
        return 20.0 + $this->peso * 5.0+ ($this->distancia > 500) ? $this->distancia * 0.1 : 0.0;
    }
}
