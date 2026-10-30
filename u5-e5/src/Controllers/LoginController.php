<?php
declare(strict_types=1);
namespace Controllers;


use Lib\Pages;
use Models\Usuario;

class LoginController
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
        // Por defecto sin datos ni errores (primera carga o GET)
        $this->page->render('usuario/formulario', [
            'errores' => [],
            'datos'   => [],
        ]);
    }
    public function verificar(Usuario $usuario): bool{
        if($this->usuario->getNombre() === $usuario->getNombre() && $this->usuario->getCont() === $usuario->getCont())
            return true;
        else
            return false;
    }
    
}