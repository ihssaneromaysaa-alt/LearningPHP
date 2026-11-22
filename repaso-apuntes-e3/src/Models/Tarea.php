<?php
declare(strict_types=1);

namespace Models;

class Tarea
{
    public string $id;
    public function __construct(
        private string $texto = '',
        private bool $hecha = false,
    ) {
        $this->id = uniqid("",true);
    }

    public static function fromArray(array $datos): self{
        return new self(
            texto: trim((string)($datos['texto'] ?? '')),
            hecha: !empty($datos['hecha']),
        );
    }
    public static function toArray(Tarea $tarea):array{
        return [$tarea->id, $tarea->texto, $tarea->hecha];
    }
}

