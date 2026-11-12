<?php
declare(strict_types=1);

namespace Models;

// simula la base de datos con un unico usuario ficticio
class Imagen
{
    private string $foto = '';

    public function __construct(string $foto='')
    {
        $this->foto = $foto;
    }
    public static function fromArray(array $datos): self{
        
        $usuario = new Imagen(
            trim($datos['foto']??''),
        );
        return $usuario;
    }
}
