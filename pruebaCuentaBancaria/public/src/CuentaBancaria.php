
<?php
class CuentaBancaria {
    public function __construct(
        protected string $titular,
        protected float $saldo = 0
    ) {}

    public function getSaldo(): float {
        return $this->saldo;
    }

    public function ingresar(float $cantidad): void {
        if ($cantidad <= 0) {
            echo "ERROR: La cantidad debe ser positiva\n";
            return;
        }

        $this->saldo += $cantidad;
    }

    public function retirar(float $cantidad): void {
        if ($cantidad <= 0) {
            echo "ERROR: La cantidad debe ser positiva\n";
            return;
        }

        if ($cantidad > $this->saldo) {
            echo "ERROR: Saldo insuficiente\n";
            return;
        }

        $this->saldo -= $cantidad;
    }
}