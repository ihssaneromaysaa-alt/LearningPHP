<?php
require_once __DIR__ . "/CalcularEnvio.php";
abstract class EnvioBase implements CalcularEnvio {
    function __construct(protected float $peso,
                        protected float $distancia,
                        private string $tipo_envio){
    }
    function calcular_tarifa():float{
        return $this->peso * $this->distancia;
    }
    public function calcularCosto(): float{
        $cadena="Envio".$this->tipo_envio;
        return new $cadena()->calcular_tarifa();
    }
}