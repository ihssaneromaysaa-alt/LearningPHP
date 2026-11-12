<?php
declare(strict_types=1);

namespace Requests;

// sanea y valida los datos del formulario de login
final class UsuarioRequests
{
    private array $datos = [];
    private array $archivo = [];
    private array $errores = [];

    public function __construct(array $entrada, array $archivo)
    {
        $this->sanear($entrada, $archivo);
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

    private function sanear(array $datos, array $archivo): void
    {
        $texto = static fn(mixed $v): string => is_string($v) ? trim(strip_tags($v)) : '';

        $this->datos = [
            'usuario' => $texto($datos['usuario'] ?? ''),
            // la contraseña no se modifica: ni trim ni strip_tags
            'password' => is_string($datos['password'] ?? null) ? $datos['password'] : '',
        ];
        $this->archivo = $archivo;

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



        // lo que aparece en $archivo:
        /**
         * 
         * [
         *   'name'     => 'foto.jpg',
         *   'type'     => 'image/jpeg',
         *   'tmp_name' => '/tmp/phpXXXXXX',
         *   'error'    => 0,
         *   'size'     => 12345
         *    ]
         */
        if (empty($this->archivo) || !isset($this->archivo['error'])) {
        $this->errores['foto'] = 'No se ha enviado ninguna foto.';
        return;
        }

        // error de subida de php
        if ($this->archivo['error'] !== UPLOAD_ERR_OK) {
            $this->errores['foto'] = match ($this->archivo['error']) {
                UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE => 'La foto es demasiado grande.',
                UPLOAD_ERR_PARTIAL                       => 'La foto se subió parcialmente.',
                UPLOAD_ERR_NO_FILE                       => 'No se ha seleccionado ninguna foto.',
                default                                  => 'Error al subir la foto.',
            };
            return;
        }

        // tamaño máximo (ejemplo: 2 MB)
        if ($this->archivo['size'] > 2 * 1024 * 1024) {
            $this->errores['foto'] = 'La foto no puede superar los 2 MB.';
            return;
        }

        // tipos permitidos
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE); 
        $mime  = finfo_file($finfo, $this->archivo['tmp_name']);// el tipo de imagen real del archivo enviado


        if (!in_array($mime, $tiposPermitidos, true)) {
            $this->errores['foto'] = 'Solo se permiten imágenes JPG, PNG o WEBP.';
            return;
        }

        // extensión
        $extension = strtolower(pathinfo($this->archivo['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'], true)) {
            $this->errores['foto'] = 'Extensión de archivo no permitida.';
        }

    }
    public function archivo(): array
    {
        return $this->archivo;
    }
}
