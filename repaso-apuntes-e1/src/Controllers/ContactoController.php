<?php
declare(strict_types=1);

namespace Controllers;

use Core\Pages;
use Requests\ContactoRequests;
use Models\Contacto;
final class ContactoController
{
    private string $dir  = BASE_PATH . '/public/data';
    private string $ruta = BASE_PATH . '/public/data/contactos.txt';
    public function index(): void
    {
        $user = [];
        if (!is_dir($this->dir)) {
            mkdir($this->dir, 0755, true);   // solo la carpeta data/
        }

        if (!is_file($this->ruta)) {
            file_put_contents($this->ruta, '');  // crea el fichero vacío
        }

        // leer el archivo
        $lineas = file($this->ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach($lineas as $linea){
            $partes = explode('|', $linea);
            if(count($partes) === 3){
                $user[] = [
                    'nombre' => $partes[0],
                    'telefono' => $partes[1],
                    'email' => $partes[2],

                ];
            }    
        }
        (new Pages())->render('contactos/index', ['user'=>$user]);
    }
    public function form(): void
    {
        (new Pages())->render('contactos/form', []);
    }

    public function validar(): ?array{
        $entrada = $_POST['user'] ?? [];

        $request = new ContactoRequests(
            is_array($entrada) ? $entrada : []
        );
        if (!$request->esValido()) {
            (new Pages())->render('contactos/form', [ 
                'user' => $request->datos(),
                'errores'  => $request->errores(),
            ]);
            return null;
        }
        return $request->datos();
    }
    public function guardar(): void
    {
        $datos = $this->validar();
        if ($datos === null)
            return;
        $linea = $datos['nombre'] . '|' . $datos['telefono'] . '|' . $datos['email'] . "\n";
        file_put_contents($this->ruta, $linea, FILE_APPEND | LOCK_EX);
        redirect('/');
    }
    public function vaciar():void{ 
        file_put_contents($this->ruta, '');
        redirect('/');
    }
}