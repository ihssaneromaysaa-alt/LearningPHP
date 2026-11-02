<?php
declare(strict_types=1);

namespace Controllers;

use Lib\Pages;
use Models\Usuario;
use Requests\UsuarioRequests;

/**
 * sanea, valida y comprueba las credenciales (simuladas) antes de dar acceso
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

    public function formulario(): void
    {
        // get: mostrar el formulario vacio
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->page->render('usuario/formulario', [
                'errores' => [],
                'datos'   => [],
            ]);
            return;
        }

        // los campos llegan como usuario[usuario] y usuario[password]
        $entrada = $_POST['usuario'] ?? [];
        $request = new UsuarioRequests(is_array($entrada) ? $entrada : []);

        // datos mal formados: volver a pintar el formulario con los errores
        if (!$request->esValido()) {
            $this->page->render('usuario/formulario', [
                'errores' => $request->errores(),
                'datos'   => ['usuario' => $request->datos()['usuario']],
            ]);
            return;
        }

        $datos = $request->datos();

        // credenciales correctas: guardar sesion y redirigir a la bienvenida
        if ($this->usuario->comprobar($datos['usuario'], $datos['password'])) {
            $this->iniciarSesion();
            session_regenerate_id(true);
            $_SESSION['usuario'] = $datos['usuario'];

            header('Location: index.php?controller=auth&action=bienvenida');
            exit;
        }

        // credenciales incorrectas: redirigir a la pagina de error
        header('Location: index.php?controller=auth&action=error');
        exit;
    }

    public function bienvenida(): void
    {
        $this->iniciarSesion();

        // sin sesion no se puede ver la bienvenida
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?controller=auth&action=formulario');
            exit;
        }

        $this->page->render('usuario/bienvenida', [
            'nombre' => $_SESSION['usuario'],
        ]);
    }

    public function error(): void
    {
        http_response_code(401);
        $this->page->render('usuario/error', []);
    }

    public function salir(): void
    {
        $this->iniciarSesion();
        $_SESSION = [];
        session_destroy();

        header('Location: index.php?controller=auth&action=formulario');
        exit;
    }

    // arranca la sesion solo si no esta ya activa
    private function iniciarSesion(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
}