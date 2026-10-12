<?php 
class Persona {
    protected string $nombre;
    protected string $apellido;

    public function __construct(string $nombre, string $apellido) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getApellido(): string {
        return $this->apellido;
    }

    public function getNombreCompleto(): string {
        return $this->nombre . " " . $this->apellido;
    }
}

?>