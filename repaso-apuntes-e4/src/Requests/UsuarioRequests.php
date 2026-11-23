<?php
declare(strict_types=1);

namespace Requests;

// sanea y valida los datos del formulario de login
final class UsuarioRequests
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
            'usuario' => $texto($datos['usuario'] ?? ''),
            // la contraseña no se modifica: ni trim ni strip_tags
            'password' => is_string($datos['password'] ?? null) ? $datos['password'] : '',
        ];
    }

    private function validar(): void
    {
        
        $d = $this->datos;
        
        // usuario
        if ($d['usuario'] === '') {
            $this->errores['usuario'] = 'El usuario es obligatorio.';
        } elseif (mb_strlen($d['usuario']) < 5) {
            $this->errores['usuario'] = 'El usuario debe tener al menos 5 caracteres.';
        } elseif (mb_strlen($d['usuario']) > 50) {
            $this->errores['usuario'] = 'El usuario no puede superar los 50 caracteres.';
        } elseif (!preg_match('/^[A-Za-z]+$/', $d['usuario'])) {
            $this->errores['usuario'] = 'El usuario solo puede contener letras.';
        }

        // contraseña: en el login solo se exige que venga informada
        // (la politica de contraseña fuerte se aplica al registrar, no al entrar)
        if ($d['password'] === '') {
            $this->errores['password'] = 'La contraseña es obligatoria.';
        } elseif (mb_strlen($d['password']) < 12) {
            $this->errores['password'] = 'La contraseña debe tener al menos 12 caracteres.';
        } elseif (!preg_match('/[A-Z]/', $d['password'])) {
            $this->errores['password'] = 'La contraseña debe tener al menos una mayúscula.';
        } elseif (!preg_match('/[a-z]/', $d['password'])) {
            $this->errores['password'] = 'La contraseña debe tener al menos una minúscula.';
        } elseif (!preg_match('/[#._$_-]/', $d['password'])) {
            $this->errores['password'] = 'La contraseña debe tener al menos un carácter especial: #, ., _, $ o -.';
        }
    }
}
