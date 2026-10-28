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
            trim($datos['apellidos']??''),
            trim($datos['correo']??''),
            ($datos['metodosPago']??[]),
            ($datos['marcar']??false)
        );
    }
}