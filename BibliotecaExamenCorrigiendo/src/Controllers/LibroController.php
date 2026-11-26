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
    public function store(): void
    {
        // TODO (apartado 4): crear new LibroRequest($_POST, $_FILES).
        //      Si no es válido -> render('libro/formulario') con 'errores' y 'datos', y return.
        $entrada = [
            'titulo'=>$_POST['libro'],
        'autor'=>$_POST['autor'],
        'genero'=>$_POST['genero'],
        'anio'=>$_POST['anio'],
        'paginas'=>$_POST['paginas']] ?? [];
        $archivo =  $_FILES['portada'] ?? [];

        $request = new LibroRequests(
            is_array($entrada) ? $entrada : [],
            is_array($archivo) ? $archivo : []
        );

        if (!$request->esValido()) {
            new Pages()->render('libro/formulario', [
                'errores' => $request->errores(),
                'datos' => [is_array($entrada ?? null)? $entrada : ''],
            ]);
            return;
        }

        $datos = $request->datos();
        $archivo = $request->archivo();

        // TODO (apartado 5):
        //      1. Generar el nombre único de la imagen (todavía no se mueve).
        //      2. Crear el objeto Libro con ese nombre de portada.
        //      3. Si existe() -> render('libro/formulario') con $errores['general'], y return.
        //      4. Mover la imagen a RUTA_IMG.
        //
        // TODO (apartado 6):
        //      guardar() -> render('libro/formulario') con 'mensaje' y 'libro'.
        //      Si falla -> borrar la imagen que ya se había movido y mostrar un error.

        // crear la carpeta si no existe
        $rutaCarpeta = RUTA_IMG;
        if (!is_dir($rutaCarpeta)) {
            if (!mkdir($rutaCarpeta, 0775, true)) {
                throw new \RuntimeException('No se pudo crear la carpeta.');
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

        $libro = new Libro($datos['titulo'],$datos['autor'],$datos['genero'], $datos['anio'], $datos['paginas'], $nombreFinal);
        if($libro->existe()){
             new Pages()->render('libro/formulario', [
                "errores['general']" => 'este libro ya existe',
                'datos' => [is_array($entrada ?? null)? $entrada : ''],
            ]);
            return;
        }
        // construir la ruta definitiva
        $rutaDestino = $rutaCarpeta . $nombreFinal;

        // mover la foto a uploads
        if (!move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
            new Pages()->render('imagen/formulario', [
                'errores' => [
                    'foto' => 'No se ha podido guardar la foto.'
                ]
            ]);
            return;
        }

        redirect('/');
        exit;
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
