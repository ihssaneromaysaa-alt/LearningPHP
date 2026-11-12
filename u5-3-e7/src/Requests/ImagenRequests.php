<?php
declare(strict_types=1);

namespace Requests;

// sanea y valida los datos del formulario de login
final class ImagenRequests
{
    private array $archivo = [];
    private array $errores = [];

    public function __construct(array $archivo)
    {
        $this->sanear($archivo);
        $this->validar();
    }

    public function esValido(): bool
    {
        return $this->errores === [];
    }

    public function errores(): array
    {
        return $this->errores;
    }

    private function sanear(array $archivo): void
    {
        $this->archivo = $archivo;
    }

    private function validar(): void
    {
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
