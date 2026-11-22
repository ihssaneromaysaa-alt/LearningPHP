<?php
declare(strict_types=1);

namespace Controllers;

use Core\Pages;
use Requests\NotasRequests;
use Models\Tarea;
final class TareasController
{
    private string $dir  = BASE_PATH . '/public/data';
    private string $ruta = BASE_PATH . '/public/data/notas.txt';
    public function index(): void{
        // variable notas vacia, para utilizarla luego
        $notas = [];
        if (!is_dir($this->dir))
            mkdir($this->dir, 0755, true);   // solo la carpeta data/

        if (!is_file($this->ruta))
            file_put_contents($this->ruta, '');  // crea el fichero vacío si no existe

        // leer el archivo
        $lineas = file($this->ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach($lineas as $linea){
            $partes = explode('|', $linea);
            if (count($partes) >= 3) {
                $notas[] = [
                    'texto' => $partes[0],
                    'hecha' => $partes[1],
                    'id'    => $partes[2],
                ];
            }
        }
        (new Pages())->render('notas/index', ['user'=>$notas]);
    }
    public function form(): void
    {
        (new Pages())->render('notas/index', []);
    }

    public function validar(): ?array{
        $entrada = $_POST['notas'] ?? [];
        $entrada['hecha'] = !empty($entrada['hecha']) ? '1' : '0';

        $request = new NotasRequests($entrada);

        if (!$request->esValido()) {
            (new Pages())->render('notas/index', [
                'notas'   => $request->datos(),
                'errores' => $request->errores(),
            ]);
            return null;
        }

        $tarea = Tarea::fromArray($request->datos()); // que asigne id dentro
        return [$request->datos(), $tarea->id];
    }
    public function guardar(): void
    {
        
        $datos = $this->validar();
        if ($datos === null)
            return;
        $hecha = !empty($datos[0]['hecha']) ? '1' : '0';
        $id    = $datos[1]; // el id que generas
        $linea = $datos[0]['texto'] . '|' . $hecha . '|' . $id . "\n";
        file_put_contents($this->ruta, $linea, FILE_APPEND | LOCK_EX);
        redirect('/');
    }
    public function hacerTarea(): void{
        $id = $_POST['id'] ?? '';
        if ($id === '') {
            redirect('/');
            return;
        }

        $lineas = file($this->ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
        $nuevas = [];

        foreach ($lineas as $linea) {
            $partes = explode('|', $linea);

            // formato: texto|hecha|id
            if (count($partes) >= 3 && $partes[2] === $id) {
                $partes[1] = ($partes[1] === '1') ? '0' : '1'; // invertir
                $linea = $partes[0] . '|' . $partes[1] . '|' . $partes[2];
            }

            $nuevas[] = $linea;
        }

        // sobrescribir el fichero entero (sin file_append)
        file_put_contents(
            $this->ruta,
            $nuevas === [] ? '' : implode("\n", $nuevas) . "\n",
            LOCK_EX
        );

        redirect('/');
    }
    public function vaciar():void{ 
        if ($this->dir === false || !is_dir($this->dir)) {
            redirect('/');
            return;
        }
        foreach (scandir($this->dir) as $nombre) {
            if ($nombre === '.' || $nombre === '..')
                continue;
            $ruta = $this->dir . DIRECTORY_SEPARATOR . $nombre;
            if (is_file($ruta))
                unlink($ruta);
        }
        rmdir($this->dir);
        redirect('/');
    }
}