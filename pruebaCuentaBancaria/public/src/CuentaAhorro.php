
<?php
require_once __DIR__ . "/CuentaBancaria.php";

class CuentaAhorro extends CuentaBancaria {

    public function __construct(
        string $titular,
        float $saldo,
        private float $interes
    ) {
        parent::__construct($titular, $saldo);
    }

    public function resumen(): string {
        return "Titular: " . $this->titular .
               " | Saldo: " . $this->getSaldo() .
               " | Interés: " . $this->interes;
    }
}
?>