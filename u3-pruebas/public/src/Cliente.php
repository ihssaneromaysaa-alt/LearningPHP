<?php
class Cliente extends Persona {
    private string $codigo;

    public function __construct(string $nombre, string $apellido, string $codigo) {
        parent::__construct($nombre, $apellido);   // llamada explícita al padre
        $this->codigo = $codigo;
    }

    public function getCodigo(): string {
        return $this->codigo;
    }
}

?>