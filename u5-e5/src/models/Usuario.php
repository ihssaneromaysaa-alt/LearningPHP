<?php
declare(strict_types=1);
namespace Models;

class Usuario{
    public function __construct(
        private string $nombre,
        private string $cont
    ){}
        public static function fromArray(array $datos): self{
        return new self(
            trim($datos['nombre']??''),
            trim($datos['cont']??'')
        );
    }
    public function getNombre(): string{
        return $this->nombre;
    }
    public function getCont(): string{
        return $this->cont;
    }
}