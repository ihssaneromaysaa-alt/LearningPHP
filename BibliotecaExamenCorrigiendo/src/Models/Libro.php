<?php
declare(strict_types=1);

namespace Models;

class Libro
{

    public function __construct(
        public readonly string $titulo,
        public readonly string $autor,
        public readonly string $genero,
        public readonly int $anio,
        public readonly int $paginas,
        public readonly string $portada,
    ) {}
    public function existe(): bool{ // tenía que leer bien el archivo, linea por línea
        if (!is_readable(RUTA_BIBLIOTECA))
            return false;

        $lineas = file(RUTA_BIBLIOTECA, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lineas === false)
            return false;

        foreach ($lineas as $linea) {
            $dato = json_decode($linea, true);
            if (!is_array($dato)) {
                continue;
            }
            if (
                trim(strtoupper($dato['titulo'] ?? '')) === trim(strtoupper($this->titulo))
                && trim(strtoupper($dato['autor'] ?? '')) === trim(strtoupper($this->autor))
            ) {
                return true;
            }
        }
        return false;
    }
    public function guardar(): bool { // debería añadir la linea por linea
        if ($this->titulo === '' || $this->autor === '') {
            return false;
        }

        if (!is_dir(RUTA_CARPETA)) {
            if (!mkdir(RUTA_CARPETA, 0755, true)) {
                throw new \RuntimeException('No se pudo crear la carpeta de datos.');
            }
        }

        $linea = json_encode($this->toArray(), JSON_UNESCAPED_UNICODE) . "\n";
        $resultado = file_put_contents(RUTA_BIBLIOTECA, $linea, FILE_APPEND | LOCK_EX);

        return $resultado !== false;
    }

    public function toArray(): array{
        return ['titulo'=>$this->titulo, 
        'autor'=> $this->autor,
        'genero'  => $this->genero,
        'anio'=> $this->anio,
        'paginas'=> $this->paginas,
        'portada'=> $this->portada];
    }
    // función para pasar de un array a un objeto libro
    public static function fromArray(array $datos): self{
        return new self(
            titulo: trim($datos['titulo'] ?? ''),
            autor: trim($datos['autor'] ?? ''),
            genero: trim((string)($datos['genero'] ?? '')),
            anio: $datos['anio'] ?? 0,
            paginas: $datos['paginas'] ?? 0,
            portada: trim($datos['portada'] ?? ''),
        );
    }
    // función para pasar de json a libro
    public static function fromJSON(string $linea ): self{
        $arrayLibro = json_decode($linea, true);
        return Libro::fromArray($arrayLibro);
    }
    
}

/*
Biblioteca del instituto
Catálogo Alta de libro
Catálogo
( ! ) Fatal error: Uncaught Error: Cannot use object of type Models\Libro as array in 
/var/www/projects/bibliotecaexamen/Views/libro/catalogo.php on line 14 ( ! ) 
Error: Cannot use object of type Models\Libro as array in 
/var/www/projects/bibliotecaexamen/Views/libro/catalogo.php on line 14 
Call Stack #TimeMemoryFunctionLocation 10.0186430248{main}( ).../index.php:0 20.0305430696require_once
( '/var/www/projects/bibliotecaexamen/src/bootstrap.php ).../index.php:2 30.2531434456Core\Router::dispatch( ).
../bootstrap.php:17 40.2532434736Core\Router::run( $controller = [0 => 'Controllers\\LibroController', 1 => 'index'],
 $params = [] ).../Router.php:64 50.2942435008call_user_func_array:{/var/www/projects/bibliotecaexamen/src/Core/
 Router.php:121}( $callback = [0 => class Controllers\LibroController { }, 1 => 'index'], $args = [] ).../Router
 .php:121 60.2942435192Controllers\LibroController->index( ).../Router.php:121 70.3505462544Core\Pages->render(
     $pageName = 'libro/catalogo', $params = ['libros' => [0 => class Models\Libro { ... }, 1 => class Models\L
     ibro { ... }]] ).../LibroController.php:45 80.4138463096require( '/var/www/projects/bibliotecaexamen/Views/lib
     ro/catalogo.php ).../Pages.php:27
     */