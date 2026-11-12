<?php
declare(strict_types=1);

namespace Controllers;

use lib\Pages;
use Models\Usuario;

class UsuarioController
{
    private $usuario;
    private $page;
    public function __construct()
    {
        $this->usuario = new Usuario();
        $this->page = new Pages();
    }
    public function formulario(): void
    {
        $this->page->render('usuario/formulario', [
            'errores' => [],
            'datos' => [],
        ]);
    }
    public function registrar(): void
    {
        // recoger datos del formulario
        $usuario = [
            "nombre" => trim($_POST["nombre"]) ?? "",
            "correo" => trim($_POST["correo"]) ?? "",
            "edad" => trim($_POST["edad"]) ?? "",

        ];

        // guardar usuario
        $this->usuario->guardarUsuario($usuario);

        // redirigir al listado
        header("Location: index.php?controller=usuario&action=listar");
        exit;
    }
    public function listar(){
        $usuarios = $this->usuario->obtenerUsuarios();
        $this->page->render('usuario/usuarios',[
            'usuarios'=>$usuarios
        ], 'USUARIOS');
    }
}