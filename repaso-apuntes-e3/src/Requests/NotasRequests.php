<?php
declare(strict_types=1);

namespace Requests;

// sanea y valida los datos del formulario de login
final class NotasRequests
{
    private array $datos = [];
    private array $errores = [];

    public function __construct(array $entrada)
    {
        
        $this->sanear($entrada);
        $this->validar();
    }

    public function esValido(): bool
    {
        return $this->errores === [];
    }

    public function datos(): array
    {
        return $this->datos;
    }

    public function errores(): array
    {
        return $this->errores;
    }

    private function sanear(array $datos): void
    {
        $texto = static fn(mixed $v): string => is_string($v) ? trim(strip_tags($v)) : '';

        $this->datos = [
            'texto' => $texto($datos['texto'] ?? ''),
            'hecha' => !empty($datos['hecha']) ? '1' : '0',
        ];
    }

    private function validar(): void
    {
        
        $d = $this->datos;
        
        // texto
        if ($d['texto'] === '') {
            $this->errores['texto'] = 'El texto es obligatorio.';
        } elseif (mb_strlen($d['texto']) < 5) {
            $this->errores['texto'] = 'El texto debe tener al menos 5 caracteres.';
        } elseif (mb_strlen($d['texto']) > 100) {
            $this->errores['texto'] = 'El texto no puede superar los 100 caracteres.';
        } /* elseif (!preg_match('/^([A-Za-z]||\h)+$/', $d['texto'])) {
            $this->errores['texto'] = 'El texto solo puede contener letras.';
        }*/ 

    }
}
