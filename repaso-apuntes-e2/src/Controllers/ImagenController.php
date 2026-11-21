<?php
declare(strict_types=1);

namespace Controllers;

use Core\Pages;
use Models\Imagen;
use Requests\ImagenRequests;

/**
 * sanea y valida los datos y comprueba las credenciales (simuladas);
 * muestra la bienvenida o vuelve al formulario con los errores.
 */
final class ImagenController
{
    private Pages $page;
    private array $archivo;
    public function __construct()
    {
        $this->page = new Pages();
        $this->archivo = [];
    }

    // get: muestra el formulario. post: valida y comprueba las credenciales
    
    public function cargarImagen(): void
    {
        if (!$this->validarImagen()) {
            return; // no continúes
        }
        $archivo = $this->archivo;

        // crear la carpeta uploads si no existe
        $rutaCarpeta = __DIR__ . '/../../public/uploads/';
        if (!is_dir($rutaCarpeta)) {
            if (!mkdir($rutaCarpeta, 0775, true)) {
                throw new \RuntimeException('No se pudo crear la carpeta uploads.');
            }
        }

        // obtener la extensión del archivo validado
        $mime = (new \finfo(FILEINFO_MIME_TYPE))->file($archivo['tmp_name']);

        // las extensiones aprobadas:
        $extensiones = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
        ];
        $extension = $extensiones[$mime];

        // crear un nombre único
        $nombreFinal = uniqid(time().'_foto_', true) . '.' . $extension;

        // construir la ruta definitiva
        $rutaDestino = $rutaCarpeta . $nombreFinal;

        // mover la foto a uploads
        if (!move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
            $this->page->render('imagen/formulario', [
                'errores' => [
                    'foto' => 'No se ha podido guardar la foto.'
                ]
            ]);
            return;
        }

        redirect('/');
        exit;
    }
    public function inicio(): void
    {
        (new Pages())->render('imagen/formulario', []);
    }
    public function eliminarImagen(): void
    {
        $rutaCarpeta = realpath(__DIR__ . '/../../public/uploads');
        if ($rutaCarpeta === false) {
            redirect('/');
            return;
        }

        // solo el nombre, sin rutas
        $nombre = basename($_POST['archivo'] ?? '');

        $rutaFinal = $rutaCarpeta . DIRECTORY_SEPARATOR . $nombre;

        // que exista y esté dentro de uploads
        $real = realpath($rutaFinal);
        if ($real !== false
            && str_starts_with($real, $rutaCarpeta . DIRECTORY_SEPARATOR)
            && is_file($real)
        ) {
            unlink($real);
        }

        redirect('/');
    }
    
    public function eliminarGaleria(): void{
        $rutaCarpeta = realpath(__DIR__ . '/../../public/uploads');
        if ($rutaCarpeta === false || !is_dir($rutaCarpeta)) {
            redirect('/');
            return;
        }

        foreach (scandir($rutaCarpeta) as $nombre) {
            if ($nombre === '.' || $nombre === '..') {
                continue;
            }
            $ruta = $rutaCarpeta . DIRECTORY_SEPARATOR . $nombre;
            if (is_file($ruta)) {
                unlink($ruta);
            }
        }
        rmdir($rutaCarpeta);
        redirect('/');
    }
    public function validarImagen(){
        $archivo =  $_FILES['foto'] ?? [];

        $request = new ImagenRequests(
            is_array($archivo) ? $archivo : []
        );
        if (!$request->esValido()) {
            $this->page->render('imagen/formulario', [
                'errores' => $request->errores(),
                'datos' => [],
            ]);
            return false;
        }
        $this->archivo = $request->archivo();
        return true;
    }
}
