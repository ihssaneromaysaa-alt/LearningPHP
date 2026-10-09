<?php
require_once __DIR__ . "/CuentaBancaria.php";
class CuentaAhorro extends CuentaBancaria {

    public function __construct(string $titular, float $saldo, float $interes){
        parent::__construct($titular, $saldo);
    }

    public function resumen(): string {
        return " titular: " . $this->titular .
               "  | saldo: " . $this->getSaldo();
    }
}
?>