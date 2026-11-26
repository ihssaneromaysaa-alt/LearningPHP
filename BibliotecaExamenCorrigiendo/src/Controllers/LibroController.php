<?php
declare(strict_types=1);

namespace Controllers;

use Core\Pages;
use Models\Libro;
use Requests\LibroRequests;

/** controlador del modelo Libro. */
final class LibroController {
    public function create(): void {
        new Pages()->render('libro/formulario');
    }

    /** Procesa el alta de un libro. */
    public function store(): void {
        $request = new LibroRequests($_POST, $_FILES['portada'] ?? []);

        if (!$request->esValido()) {
            new Pages()->render('libro/formulario', [
                'errores' => $request->errores(),
                'datos'   => $request->datos(),
            ]);
            return;
        }

        $datos   = $request->datos();
        $archivo = $request->archivo();

        // Nombre único de la imagen
        $mime = (new \finfo(FILEINFO_MIME_TYPE))->file($archivo['tmp_name']);
        $extensiones = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp',
        ];
        $extension  = $extensiones[$mime] ?? 'jpg';
        $nombreFinal = uniqid('portada_', true) . '.' . $extension;

        $libro = new Libro(
            $datos['titulo'],
            $datos['autor'],
            $datos['genero'],
            (int)$datos['anio'],
            (int)$datos['paginas'],
            $nombreFinal
        );

        if ($libro->existe()) {
            new Pages()->render('libro/formulario', [
                'errores' => ['general' => 'Este libro ya existe en la biblioteca.'],
                'datos'   => $datos,
            ]);
            return;
        }

        $rutaDestino = RUTA_IMG . $nombreFinal;

        if (!move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
            new Pages()->render('libro/formulario', [
                'errores' => ['portada' => 'No se ha podido guardar la portada.'],
                'datos'   => $datos,
            ]);
            return;
        }

        if (!$libro->guardar()) {
            // Si falla el guardado, borramos la imagen ya movida
            if (is_file($rutaDestino)) {
                unlink($rutaDestino);
            }
            new Pages()->render('libro/formulario', [
                'errores' => ['general' => 'Error al guardar el libro.'],
                'datos'   => $datos,
            ]);
            return;
        }

        new Pages()->render('libro/formulario', [
            'mensaje' => 'Libro guardado correctamente.',
            'libro'   => $libro,
        ]);
    }
    public function index(): void
    {
        $libros = [];

        // TODO (apartado 3): rellenar $libros leyendo RUTA_BIBLIOTECA línea por línea
        //      (un array de objetos Libro).

        $lineas = file(RUTA_BIBLIOTECA, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach($lineas as $linea){
            $libros[] = Libro::fromJSON($linea);
        }
        new Pages()->render('libro/catalogo', ['libros' => $libros]);
    }
}
