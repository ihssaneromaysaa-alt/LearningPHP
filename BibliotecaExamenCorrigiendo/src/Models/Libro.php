<?php
declare(strict_types=1);

namespace Models;

class Libro
{

    public function __construct(
        public readonly string $titulo,
        public readonly string $autor,
        public readonly array $genero,
        public readonly int $anio,
        public readonly int $paginas,
        public readonly string $portada, 
    ) {}
    public function existe(): bool {
        // leer el archivo json con file_exists y is_readable
        $ruta = RUTA_USUARIOS;
        if (!file_exists($ruta) || !is_readable($ruta))
            return false;
        $json = file_get_contents($ruta);
        if ($json === false)
            return false;
        $datos = json_decode($json, true);
        //if (!isset($datos['titulo']))
        //    return false; // titulo no existe
        // buscar en datos el titulo con el mismo autor 
        foreach($datos as $dato){
            if(trim(strtoupper($dato['titulo'])) == trim(strtoupper($this->titulo)) && trim(strtoupper($dato['autor'])) == trim(strtoupper(($this->autor)))){
                return true;
            }
        }
        return false;
    }
    public function guardar():bool{
        // validar que el titulo y el o la autor o autora no estén vacíos
        if (empty($this->titulo) || empty($this->autor) )
            return false;

        // definir la ruta de la carpeta y el archivo
        $rutaCarpeta = RUTA_CARPETA;
        $rutaArchivo = RUTA_BIBLIOTECA;

        // crear la carpeta si no existe
        if (!file_exists($rutaCarpeta)) {
            if (!mkdir($rutaCarpeta, 0755, true)) {
                throw new \RuntimeException("No se pudo crear la carpeta de datos.");
            }
        }
        // crear el archivo si no existe
        if (!file_exists($rutaArchivo))
            if (file_put_contents($rutaArchivo, '') === false) 
                throw new \RuntimeException("Error al crear el archivo de libros.");


        // leer el archivo json existente
        $json = file_get_contents($rutaArchivo);
        if ($json === false)
            throw new \RuntimeException("Error al leer el archivo de libros.");
        $datos = json_decode($json, true);
        

        // verificar si el libro ya existe
        foreach($datos as $dato){
            if(trim(strtoupper($dato['titulo'])) == trim(strtoupper($this->titulo)) && trim(strtoupper($dato['autor'])) == trim(strtoupper(($this->autor)))){
                return false; // si el libro ya existe no se añade de nuevo
            }
        }

        // recoger el array con los datos del libro
        $datos[] = $this->toArray();

        // guardar los datos actualizados en el archivo JSON
        $jsonActualizado = json_encode($datos, JSON_UNESCAPED_UNICODE);
        if ($jsonActualizado === false)
            throw new \RuntimeException("Error al codificar los datos a JSON.");
        $resultado = file_put_contents($rutaArchivo, $jsonActualizado);
        if ($resultado === false)
            throw new \RuntimeException("Error al guardar el archivo de usuarios.");

        return true;
    }
    public function toArray(): array{
        return ['titulo'=>$this->titulo, 
        'autor'=> $this->autor,
        'genero'=> $this->genero,
        'anio'=> $this->anio,
        'paginas'=> $this->autor,
        'portada'=> $this->portada];
    }
    // función para pasar de un array a un objeto libro
    public static function fromArray(array $datos): self{
        return new self(
            titulo: trim($datos['titulo'] ?? ''),
            autor: trim($datos['autor'] ?? ''),
            genero: ([$datos['genero']] ?? []),
            anio: $datos['anio'] ?? '',
            paginas: $datos['paginas'] ?? '',
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