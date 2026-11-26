<?php
declare(strict_types=1);

namespace Requests;

final class LibroRequests
{
    private array $archivo = [];
    private array $datos = [];
    private array $errores = [];

    public function __construct(array $entrada, array $archivo)
    {
        $this->sanear($entrada);
        $this->sanearLibro($archivo);
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
    public function datos(): array
    {
        return $this->datos;
    }

    private function sanear(array $entrada): void
    {
        $texto = static fn(mixed $v): string => is_string($v) ? trim(strip_tags($v)) : '';

        $genero = $texto($entrada['genero'] ?? '');
        if (!in_array($genero, GENEROS, true)) {
            $genero = '';
        }

        $this->datos = [
            'titulo'  => $texto($entrada['titulo'] ?? ''),
            'autor'   => $texto($entrada['autor'] ?? ''),
            'genero'  => $genero,
            'anio'    => $texto($entrada['anio'] ?? ''),
            'paginas' => $texto($entrada['paginas'] ?? ''),
        ];
    }
    private function sanearLibro(array $archivo){
        $this->archivo = $archivo;
    }

    private function validar(): void
    {
        $d = $this->datos;

        if ($d['titulo'] === '') {
            $this->errores['titulo'] = "El titulo es obligatorio.";
        } 

        if ($d['autor'] !== '') {
            if (mb_strlen($d['autor']) < 2) {
                $this->errores['autor'] = "Los autor deben tener al menos 2 caracteres.";
            } elseif (mb_strlen($d['autor']) > 100) {
                $this->errores['autor'] = "Los autor no pueden superar los 100 caracteres.";
            } elseif (!preg_match('/^[\pL\s\'\.]+$/u', $d['autor'])) {
                $this->errores['autor'] = "El autor solo pueden contener letras, espacios y puntos.";
            }
        }
        else{
            $this->errores['autor'] = "Este campo es obligatorio.";
        }

        if ($d['genero'] === []) {
            $this->errores['genero'] = 'Debes seleccionar al menos un genero.';
        }

        if ($d['anio'] === '' || !ctype_digit($d['anio']) || (int)$d['anio'] < 1) {
            $this->errores['anio'] = 'El año debe ser un número mayor que 0.';
        }

        if ($d['paginas'] === '' || !ctype_digit($d['paginas']) || (int)$d['paginas'] < 1) {
            $this->errores['paginas'] = 'Las páginas deben ser un número mayor que 0.';
        }


        // validar archivo
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

        // tamaño máximo 500 KB
        if ($this->archivo['size'] > 500 * 1024) {
            $this->errores['portada'] = 'La portada no puede superar los 500 KB.';
            return;
        }

        // tipos permitidos
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE); 
        $mime  = finfo_file($finfo, $this->archivo['tmp_name']);// el tipo de imagen real del archivo enviado


        if (!in_array($mime, $tiposPermitidos, true)) {
            $this->errores['portada'] = 'Solo se permiten imágenes JPG, PNG o WEBP.';
            return;
        }

        // extensión
        $extension = strtolower(pathinfo($this->archivo['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'], true)) {
            $this->errores['portada'] = 'Extensión de archivo no permitida.';
        }

    }
    public function archivo(): array
    {
        return $this->archivo;
    }
}
