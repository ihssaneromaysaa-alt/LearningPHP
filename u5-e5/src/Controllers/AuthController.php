<?php
declare(strict_types=1);

namespace Controllers;

use lib\Pages;
use Models\Usuario;
use Requests\UsuarioRequests;

/**
 * sanea y valida los datos, comprueba las credenciales (simuladas)
 * y redirige a la bienvenida o a la pagina de error.
 */
class AuthController
{
    private Pages $page;
    private Usuario $usuario;

    public function __construct()
    {
        $this->page = new Pages();
        // "base de datos" simulada: usuario / 1234
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
            $this->page->render('usuario/bienvenida', [
                'usuario' => $datos['usuario']
            ]);
            return;
        }
        
        // credenciales incorrectas
        $this->page->render('usuario/formulario', [
            'errores' => [
                'login' => 'Usuario no registrado.'
            ],
            'datos' => [
                'usuario' => $datos['usuario']
            ]
        ]);
    }

    public function error(): void
    {
        $this->page->render('usuario/error', []);
    }

    // redireccion con header(): debe ejecutarse antes de imprimir nada
    private function redirigir(string $accion): never
    {
        header('Location: index.php?controller=auth&action=' . $accion);
        exit;
    }
}