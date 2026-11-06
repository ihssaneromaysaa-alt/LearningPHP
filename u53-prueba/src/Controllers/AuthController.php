<?php
declare(strict_types=1);

namespace Controllers;

use lib\Pages;
use Models\Usuario;
use Requests\UsuarioRequests;

/**
 * sanea y valida los datos y comprueba las credenciales (simuladas);
 * muestra la bienvenida o vuelve al formulario con los errores.
 */
class AuthController
{
    private Pages $page;
    private Usuario $usuario;

    public function __construct()
    {
        $this->page = new Pages();
        // "base de datos" simulada: usuario / contra1234Ab_
        $this->usuario = new Usuario('usuario', 'contra1234Ab_');
    }

    // get: muestra el formulario. post: valida y comprueba las credenciales
    
    public function formulario(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->page->render('usuario/formulario', [
                'errores' => [],
                'datos' => [],
            ]);
            return;
        }

        $entrada = $_POST['usuario'] ?? [];
        $archivo =  $_FILES['foto'] ?? [];

        $request = new UsuarioRequests(
            is_array($entrada) ? $entrada : [],
            is_array($archivo) ? $archivo : []
        );

        if (!$request->esValido()) {
            $this->page->render('usuario/formulario', [
                'errores' => $request->errores(),
                'datos' => [
                    'usuario' => is_string($entrada['usuario'] ?? null)
                        ? $entrada['usuario']
                        : ''
                ],
            ]);
            return;
        }

        $datos = $request->datos();
        $archivo = $request->archivo();


        // comprobar las credenciales
        $entrada = $_POST['usuario'] ?? [];
        $archivo =  $_FILES['foto'] ?? [];

        $request = new UsuarioRequests(
            is_array($entrada) ? $entrada : [],
            is_array($archivo) ? $archivo : []
        );

        if (!$request->esValido()) {
            $this->page->render('usuario/formulario', [
                'errores' => $request->errores(),
                'datos' => [
                    'usuario' => is_string($entrada['usuario'] ?? null)
                        ? $entrada['usuario']
                        : ''
                ],
            ]);
            return;
        }

        $datos = $request->datos();
        $archivo = $request->archivo();

        // comprobar las credenciales
        if ($this->usuario->comprobar(
            $datos['usuario'],
            $datos['password']
        )) {

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
                $this->page->render('usuario/formulario', [
                    'errores' => [
                        'foto' => 'No se ha podido guardar la foto.'
                    ],
                    'datos' => [
                        'usuario' => $datos['usuario']
                    ]
                ]);
                return;
            }

            // iniciar la sesión
            $datos = $request->datos();
            $array = ['usuario'=>$datos['usuario'],'hash'=>$datos['password'],'foto'=>$nombreFinal];
            $usuario = Usuario::fromArray($array);
            die(var_dump($usuario));
            $this->page->render('usuario/bienvenida', [
                'usuario' => $usuario->getUsuario()
            ], 'Bienvenida');

            return;
        }
        
        // credenciales incorrectas
        $this->page->render('usuario/formulario', [
            'errores' => [
                'login' => 'Usuario no registrado, por favor registrese.'
            ],
            'datos' => [
                'usuario' => $datos['usuario']
            ]
        ]);
        
    }
}
