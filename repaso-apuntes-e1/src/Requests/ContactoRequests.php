<?php
declare(strict_types=1);

namespace Requests;

// sanea y valida los datos del formulario de login
final class ContactoRequests
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
            'nombre' => $texto($datos['nombre'] ?? ''),
            'email' => $texto($datos['email'] ?? ''),
            'telefono' => $texto($datos['telefono'] ?? ''),
        ];
    }

    private function validar(): void
    {
        
        $d = $this->datos;
        
        // nombre
        if ($d['nombre'] === '') {
            $this->errores['nombre'] = 'El nombre es obligatorio.';
        } elseif (mb_strlen($d['nombre']) < 5) {
            $this->errores['nombre'] = 'El nombre debe tener al menos 5 caracteres.';
        } elseif (mb_strlen($d['nombre']) > 50) {
            $this->errores['nombre'] = 'El nombre no puede superar los 50 caracteres.';
        } elseif (!preg_match('/^[A-Za-z]+$/', $d['nombre'])) {
            $this->errores['nombre'] = 'El nombre solo puede contener letras.';
        }

        if ($d['email'] === '') {
            $this->errores['email'] = 'El email es obligatorio.';
        } elseif (mb_strlen($d['email']) > 255) {
            $this->errores['email'] = 'El email no puede superar los 255 caracteres.';
        } elseif (!filter_var($d['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errores['email'] = 'El formato del email no es válido.';
        }

        if ($d['telefono'] !== '' && !preg_match('/^\+?[0-9\s\-]{9,15}$/', $d['telefono'])) {
            $this->errores['telefono'] = "El teléfono debe tener entre 9 y 15 dígitos (puede incluir +, espacios o guiones).";
        }
    }
}
