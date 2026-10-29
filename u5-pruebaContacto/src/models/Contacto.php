<?php
declare(strict_types=1);
namespace Models;

class Contacto{
    public function __construct(
        public string $nombre = '',
        public string $apellidos = '',
        public string $correo = '',
        public array $metodosPago = [],
        public bool $marcar = false,
    ){}
    public static function fromArray(array $datos): self{
        return new self(
            trim($datos['nombre']??''),
            trim($datos['apellido']??''),
            trim($datos['correo']??''),
            ($datos['metodosPago'] ?? []),
            (bool)($datos['marcar']??false)
        );
    }
    public function getNombre(): string{
        return $this->nombre;
    }
    public function getApellidos(): string{
        return $this->apellidos;
    }
    public function getMarcar(): bool{
        return $this->marcar;
    }
    public function getCorreo(): string{
        return $this->correo;
    }
    public function getmetodosPago(): array{
        return $this->metodosPago;
    }
}