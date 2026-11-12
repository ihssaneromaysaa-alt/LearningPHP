<?php
declare(strict_types=1);

namespace Controllers;

use lib\Pages;
use Models\Imagen;
use Requests\ImagenRequests;

/**
 * sanea y valida los datos y comprueba las credenciales (simuladas);
 * muestra la bienvenida o vuelve al formulario con los errores.
 */
class ImagenController
{
    private Pages $page;
    private Imagen $imagen;

    public function __construct()
    {
        $this->page = new Pages();
        $this->imagen = new Imagen('');
    }

    // get: muestra el formulario. post: valida y comprueba las credenciales
    
    public function formulario(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->page->render('imagen/formulario', [
                'errores' => [],
                'datos' => [],
            ]);
            return;
        }

        $archivo =  $_FILES['foto'] ?? [];

        $request = new ImagenRequests(
            is_array($archivo) ? $archivo : []
        );

        if (!$request->esValido()) {
            $this->page->render('imagen/formulario', [
                'errores' => $request->errores(),
                'datos' => [],
            ]);
            return;
        }
        $archivo = $request->archivo();


        // comprobar las credenciales
        $archivo =  $_FILES['foto'] ?? [];

        $request = new ImagenRequests(
            is_array($archivo) ? $archivo : []
        );

        if (!$request->esValido()) {
            $this->page->render('imagen/formulario', [
                'errores' => $request->errores(),
                'datos' => [],
            ]);
            return;
        }

        $archivo = $request->archivo();
        if (true) {

            // crear la carpeta uploads si no existe
            $rutaCarpeta = __DIR__ . '/../../public/uploads/';

            if (!is_dir($rutaCarpeta)) {
                if (!mkdir($rutaCarpeta, 0775, true)) {
                    throw new \RuntimeException('No se pudo crear la carpeta uploads.');
                }
            }

            // obtener la extensión del archivo validado
            $mime = (new \finfo(FILEINFO_MIME_TYPE))
                ->file($archivo['tmp_name']);

            $extensiones = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/webp' => 'webp'
            ];

            $extension = $extensiones[$mime];

            // crear un nombre único
            $nombreFinal = uniqid('foto_', true) . '.' . $extension;

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

            // iniciar la sesión
            $array = [$nombreFinal];
            $imagen = Imagen::fromArray($array);
            
            $this->page->render('imagen/bienvenida', [
                'rutaCarpeta' => $rutaCarpeta,
            ], 'Bienvenida');

            return;
        }        
    }
}
