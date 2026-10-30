<?php
declare(strict_types=1);

namespace Requests;

final class UsuarioRequests{
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
            'usuario'      => $texto($datos['usuario'] ?? ''),
            'contraseña'   => $texto($datos['contraseña'] ?? $datos['contraseña'] ?? '')
        ];
        die(var_dump($this->datos));
    }

    private function validar(): void
    {
        $d = $this->datos;
        /**
         * usuario:  mínimo 5 caracteres y solo letras
         */
        // Usuario
        if ($d['usuario'] === '') {
            $this->errores['usuario'] = 'El usuario es obligatorio.';
        } elseif (mb_strlen($d['usuario']) < 5) {
            $this->errores['usuario'] = 'El usuario debe tener al menos 5 caracteres.';
        } elseif (mb_strlen($d['usuario']) > 50) {
            $this->errores['usuario'] = 'El usuario no puede superar los 50 caracteres.';
        } elseif (!preg_match('[A-z]', $d['usuario'])) {
            $this->errores['usuario'] = 'El usuario solo puede contener letras.';
        }
        /** contraseña: una mayúscula, una minúscula, . $ # _ - un dígito y 12 caracteres
         */
        // Contraseña (opcional)
        if ($d['contraseña'] !== '') {
            if (mb_strlen($d['contraseña']) < 12) {
                $this->errores['contraseña'] = 'La contraseña debe tener al menos 12 caracteres.';
            } elseif (mb_strlen($d['contraseña']) > 100) {
                $this->errores['contraseña'] = 'Los contraseña no pueden superar los 100 caracteres.';
            } elseif (!preg_match('[A-Z]{1,}', $d['contraseña'])) {
                $this->errores['contraseña'] = 'Los contraseña solo pueden contener letras, espacios, guiones y puntos.';
            }
        }
    }
}

/**crear nuestra propia funcion que , funcion flecha */