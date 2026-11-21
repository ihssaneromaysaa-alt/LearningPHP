<?php
declare(strict_types=1);

namespace Models;

class Contacto
{
    public function __construct(
        public string $nombre = '',
        public string $telefono = '',
        public string $email = '',
    ) {}

    public static function fromArray(array $datos): self
    {
        return new self(
            nombre: trim($datos['nombre'] ?? ''),
            telefono: trim($datos['telefono'] ?? ''),
            email: trim($datos['email'] ?? ''),
        );
    }
}

