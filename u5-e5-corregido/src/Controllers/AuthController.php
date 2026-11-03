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

        $request = new UsuarioRequests(
            is_array($entrada) ? $entrada : []
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

        // comprobar las credenciales
        if ($this->usuario->comprobar(
            $datos['usuario'],
            $datos['password']
        )) {
            session_regenerate_id(true);
            $_SESSION['usuario'] = $datos['usuario'];

            $this->page->render('usuario/bienvenida', [
                'usuario' => $datos['usuario']
            ], 'Bienvenida');
            return;
        }
        
        // credenciales incorrectas
        $this->page->render('usuario/formulario', [
            'errores' => [
                'login' => 'Usuario o contraseña incorrectos.'
            ],
            'datos' => [
                'usuario' => $datos['usuario']
            ]
        ]);
    }
}
