<?php
declare(strict_types=1);
namespace Controllers;


use Lib\Pages;
use Models\Usuario;
use Requests\UsuarioRequests;
/**
 * sane valida, y comprueba que es la contraseña y muestra la página de bienvenida ya
 */
class AuthController
{
    private Pages $page;
    private Usuario $usuario;
    public function __construct()
    {
        $this->page = new Pages();
        $this->usuario = new Usuario("usuario","1234");
    }
    public function formulario(): void
    {
        // Si es GET → mostrar el formulario
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->page->render('usuario/formulario', [
                'errores' => [],
                'datos'   => [],
            ]);
            return;
        }
        $request = new UsuarioRequests($_POST['usuario']);
        /*
        $usuarioEnviado  = $_POST['usuario']['usuario'];
        $passwordEnviada = $_POST['usuario']['password'];
        $entrada = ['usuario' => $_POST['usuario']['usuario'], 'contraseña' => $_POST['usuario']['password'] ];*/
        
        /*
        $usuarioValido = [
            'usuario'  => 'Usuario',
            'password' => password_hash('1234', PASSWORD_BCRYPT) 
        ];
        if (!$request->esValido()) {
            $this->page->render('contacto/formulario', [
                'errores' => $request->errores(),
                'datos'   => $request->datos(),
            ]);
            return;
        }
        if (
            $usuarioEnviado === $usuarioValido['usuario'] &&
            password_verify($passwordEnviada, $usuarioValido['password'])
        ){
            header('Location: index.php?controller=auth&action=bienvenida&usuario=' . urlencode($usuarioEnviado));
            exit;
        }
        // Login incorrecto → volver a mostrar el formulario con error
        $this->page->render('usuario/formulario', [
            'errores' => ['login' => 'Usuario o contraseña incorrectos'],
            'datos'   => ['usuario' => $usuarioEnviado],
        ]);*/
    }
    public function bienvenida(): void{
        $usuario = $_GET['usuario'] ?? 'Usuario';

        echo "<h1>Bienvenido, " . htmlspecialchars($usuario) . "</h1>";
        echo "<p>Has iniciado sesión correctamente.</p>";
        echo "<a href='index.php?controller=usuario&amp;action=formulario'>Regresar al formulario</a>";
    }
}