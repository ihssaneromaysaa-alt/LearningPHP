<?php
declare(strict_types=1);

namespace Requests;

use DateTime;

final class ContactoRequest
{
    /** Métodos de pago que ofrece el formulario */
    public const array METODOS_PAGO = ['VISA', 'Mastercard', 'Paypal'];

    /** @var array<string, mixed> Datos ya saneados */
    private array $datos = [];

    /** @var array<string, string> Mensajes de error indexados por campo */
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

    /** @return array<string, string> */
    public function errores(): array
    {
        return $this->errores;
    }

    /** @return array<string, mixed> */
    public function datos(): array
    {
        return $this->datos;
    }

    private function sanear(array $entrada): void
    {
        $texto = static fn(mixed $v): string => is_string($v) ? trim(strip_tags($v)) : '';

        $this->datos = [
            'nombre'           => $texto($entrada['nombre'] ?? ''),
            'apellidos'        => $texto($entrada['apellidos'] ?? ''),
            'correo'           => trim($entrada['correo'] ?? ''),
            'direccion'        => $texto($entrada['direccion'] ?? ''),
            'telefono'         => $texto($entrada['telefono'] ?? ''),
            'fecha_nacimiento' => $texto($entrada['fecha_nacimiento'] ?? ''),
            'marcar'           => isset($entrada['marcar']) ? '1' : '',
        ];
    }

    private function validar(): void
    {
        $d = $this->datos;

        // --- Nombre (obligatorio, 2-50 caracteres) ---
        if ($d['nombre'] === '') {
            $this->errores['nombre'] = "El nombre es obligatorio.";
        } elseif (mb_strlen($d['nombre']) < 2) {
            $this->errores['nombre'] = "El nombre debe tener al menos 2 caracteres.";
        } elseif (mb_strlen($d['nombre']) > 50) {
            $this->errores['nombre'] = "El nombre no puede superar los 50 caracteres.";
        } elseif (!preg_match('/^[\pL\s\-\'\.]+$/u', $d['nombre'])) {
            $this->errores['nombre'] = "El nombre solo puede contener letras, espacios, guiones y puntos.";
        }

        // --- Apellidos (opcional, 2-100 caracteres si se indica) ---
        if ($d['apellidos'] !== '') {
            if (mb_strlen($d['apellidos']) < 2) {
                $this->errores['apellidos'] = "Los apellidos deben tener al menos 2 caracteres.";
            } elseif (mb_strlen($d['apellidos']) > 100) {
                $this->errores['apellidos'] = "Los apellidos no pueden superar los 100 caracteres.";
            } elseif (!preg_match('/^[\pL\s\-\'\.]+$/u', $d['apellidos'])) {
                $this->errores['apellidos'] = "Los apellidos solo pueden contener letras, espacios, guiones y puntos.";
            }
        }

        // --- Correo (obligatorio, formato válido, máx. 255 caracteres) ---
        if ($d['correo'] === '') {
            $this->errores['correo'] = "El correo es obligatorio.";
        } elseif (mb_strlen($d['correo']) > 255) {
            $this->errores['correo'] = "El correo no puede superar los 255 caracteres.";
        } elseif (!filter_var($d['correo'], FILTER_VALIDATE_EMAIL)) {
            $this->errores['correo'] = "El formato del correo no es válido.";
        }

        // --- Dirección (opcional, máx. 255 caracteres) ---
        if ($d['direccion'] !== '' && mb_strlen($d['direccion']) > 255) {
            $this->errores['direccion'] = "La dirección no puede superar los 255 caracteres.";
        }

        // --- Teléfono (opcional, 9-15 dígitos, puede incluir +, espacios o guiones) ---
        if ($d['telefono'] !== '' && !preg_match('/^\+?[0-9\s\-]{9,15}$/', $d['telefono'])) {
            $this->errores['telefono'] = "El teléfono debe tener entre 9 y 15 dígitos (puede incluir +, espacios o guiones).";
        }

        // --- Fecha de nacimiento (opcional, formato Y-m-d, no futura, no anterior a 1900) ---
        if ($d['fecha_nacimiento'] !== '') {
            $fecha = DateTime::createFromFormat('Y-m-d', $d['fecha_nacimiento']);
            if (!$fecha || $fecha->format('Y-m-d') !== $d['fecha_nacimiento']) {
                $this->errores['fecha_nacimiento'] = "La fecha de nacimiento no es válida. Formato esperado: AAAA-MM-DD.";
            } elseif ($fecha > new DateTime('today')) {
                $this->errores['fecha_nacimiento'] = "La fecha de nacimiento no puede ser futura.";
            } elseif ($fecha < new DateTime('1900-01-01')) {
                $this->errores['fecha_nacimiento'] = "La fecha de nacimiento no puede ser anterior a 1900.";
            }
        }

        // --- Términos y condiciones ---
        if ($d['marcar'] !== '1') {
            $this->errores['marcar'] = "Debes aceptar los términos y condiciones.";
        }
    }
}
