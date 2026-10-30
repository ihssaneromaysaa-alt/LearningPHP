<?php
declare(strict_types=1);

namespace Requests;

final class ContactoRequests
{
    public const array METODOS_PAGO = ['VISA', 'MASTERCARD', 'BIZUM'];

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

        // Métodos de pago: solo aceptamos los de la constante
        $metodos = [];
        if (isset($datos['metodosPago']) && is_array($datos['metodosPago'])) {
            foreach ($datos['metodosPago'] as $m) {
                $m = strtoupper(trim((string)$m));
                if (in_array($m, self::METODOS_PAGO, true)) {
                    $metodos[] = $m;
                }
            }
        }

        $this->datos = [
            'nombre'      => $texto($datos['nombre'] ?? ''),
            'apellidos'   => $texto($datos['apellido'] ?? $datos['apellidos'] ?? ''), // acepta ambos
            'correo'      => trim((string)($datos['correo'] ?? '')),
            'metodosPago' => $metodos,
            'marcar'      => isset($datos['marcar']) ? '1' : '',
        ];
    }

    private function validar(): void
    {
        $d = $this->datos;

        // Nombre
        if ($d['nombre'] === '') {
            $this->errores['nombre'] = 'El nombre es obligatorio.';
        } elseif (mb_strlen($d['nombre']) < 2) {
            $this->errores['nombre'] = 'El nombre debe tener al menos 2 caracteres.';
        } elseif (mb_strlen($d['nombre']) > 50) {
            $this->errores['nombre'] = 'El nombre no puede superar los 50 caracteres.';
        } elseif (!preg_match('/^[\pL\s\-\'\.]+$/u', $d['nombre'])) {
            $this->errores['nombre'] = 'El nombre solo puede contener letras, espacios, guiones y puntos.';
        }

        // Apellidos (opcional)
        if ($d['apellidos'] !== '') {
            if (mb_strlen($d['apellidos']) < 2) {
                $this->errores['apellidos'] = 'Los apellidos deben tener al menos 2 caracteres.';
            } elseif (mb_strlen($d['apellidos']) > 100) {
                $this->errores['apellidos'] = 'Los apellidos no pueden superar los 100 caracteres.';
            } elseif (!preg_match('/^[\pL\s\-\'\.]+$/u', $d['apellidos'])) {
                $this->errores['apellidos'] = 'Los apellidos solo pueden contener letras, espacios, guiones y puntos.';
            }
        }

        // Correo
        if ($d['correo'] === '') {
            $this->errores['correo'] = 'El correo es obligatorio.';
        } elseif (mb_strlen($d['correo']) > 255) {
            $this->errores['correo'] = 'El correo no puede superar los 255 caracteres.';
        } elseif (!filter_var($d['correo'], FILTER_VALIDATE_EMAIL)) {
            $this->errores['correo'] = 'El formato del correo no es válido.';
        }

        // Métodos de pago (al menos uno)
        if ($d['metodosPago'] === []) {
            $this->errores['metodosPago'] = 'Debes seleccionar al menos un método de pago.';
        }

        // Términos
        if ($d['marcar'] !== '1') {
            $this->errores['marcar'] = 'Debes aceptar los términos y condiciones.';
        }
    }
}