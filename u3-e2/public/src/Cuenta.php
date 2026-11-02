<?php

class Cuenta{
    private string $saldoFormateado{
        get=>number_format($this->saldo, 2, ',', '.') . ' €';
    }
    function __construct(
        private float $saldo{
            set{
                if ($value < 0) 
                throw new InvalidArgumentException('Saldo inválido');
                $this->saldo = $value;
            } 
        },
        private string $titular{
            get => trim(ucwords($this->titular));
        },
    ){}

    public function toString() : string {
        return 'saldo: '.$this->saldo.'<br>
        titular: '.$this->titular.'<br>
        saldo formateado: '.$this->saldoFormateado.'<br>';
    }
}