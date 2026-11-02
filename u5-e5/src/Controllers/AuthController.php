<?php
declare(strict_types=1);

namespace Controllers;

use Lib\Pages;
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
        $this->usuario = new Usuario('usuario', '1234');
    }

    // get: muestra el formulario. post: valida y comprueba las credenciales
    public function formulario(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->page->render('usuario/formulario', [
                'errores' => [],
                'datos' => [],
            ], 'iniciar sesión');
            return;
        }

        // los campos llegan como usuario[usuario] y usuario[password]
        $entrada = $_POST['usuario'] ?? [];
        $request = new UsuarioRequests(is_array($entrada) ? $entrada : []);

        // datos mal formados (vacios, demasiado largos...): se vuelve a pintar el formulario
        if (!$request->esValido()) {
            $this->page->render('usuario/formulario', [
                'errores' => $request->errores(),
                // la contraseña nunca se devuelve al formulario
                'datos' => ['usuario' => $request->datos()['usuario']],
            ], 'iniciar sesión');
            return;
        }

        $datos = $request->datos();

        // credenciales correctas: redirige a la bienvenida
        if ($this->usuario->comprobar($datos['usuario'], $datos['password'])) {
            $this->redirigir('bienvenida');
        }

        // credenciales incorrectas: redirige a la pagina de error
        $this->redirigir('error');
    }

    public function bienvenida(): void
    {
        $this->page->render('usuario/bienvenida', [], 'bienvenida');
    }

    public function error(): void
    {
        $this->page->render('usuario/error', [], 'acceso denegado');
    }

    // redireccion con header(): debe ejecutarse antes de imprimir nada
    private function redirigir(string $accion): never
    {
        header('Location: index.php?controller=auth&action=' . $accion);
        exit;
    }
}