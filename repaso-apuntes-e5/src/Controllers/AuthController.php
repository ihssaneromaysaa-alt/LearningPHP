<?php
declare(strict_types=1);

namespace Controllers;

use Core\Pages;
use Requests\UsuarioRequests;
use Models\Usuario;

final class AuthController
{
    public function index(): void{
        (new Pages())->render('usuario/formulario', []);
    }
    public function mostrarRegistro():void {
        (new Pages())->render('usuario/registro', []);
    }
    // cuando inicia sesión
    public function nuevo(): void{

        $entrada = $_POST['usuario'] ?? [];
        $request = new UsuarioRequests(
            is_array($entrada) ? $entrada : [], true
        );

        if (!$request->esValido()) {
            die($_POST['usuario']);
            (new Pages())->render('usuario/formulario', [
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

        // instanciar el modelo Usuario
        $usuario = new Usuario($datos['usuario'], "", $datos['password']);

        // comprobar las credenciales
        if ($usuario->comprobar($datos['usuario'], $datos['password'])) {
            (new Pages())->render('usuario/bienvenida', [
                'usuario' => $datos['usuario']
            ], 'Bienvenida');
            return;
        }

        // credenciales incorrectas
        (new Pages())->render('usuario/formulario', [
            'errores' => [
                'login' => 'usuario o contraseña incorrectos.'
            ],
            'datos' => [
                'usuario' => $datos['usuario']
            ]
        ]);
    }
    
    public function registrar(): void {
        $entrada = $_POST['usuario'] ?? [];

        if (!isset($entrada['password']) || !isset($entrada['password2']) || $entrada['password'] !== $entrada['password2']) {
            (new Pages())->render('usuario/registro', [
                'errores' => [
                    'password' => 'Las contraseñas no coinciden.'
                ],
                'datos' => [
                    'usuario' => is_string($entrada['usuario'] ?? null)
                        ? $entrada['usuario']
                        : ''
                ],
            ]);
            return;
        }

        $request = new UsuarioRequests(
            is_array($entrada) ? $entrada : [], false
        );

        if (!$request->esValido()) {
            (new Pages())->render('usuario/registro', [
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

        try {
            if (Usuario::registrar($datos['usuario'], $datos['email'], $datos['password'])) {
                (new Pages())->render('usuario/bienvenida', [
                    'usuario' => $datos['usuario']
                ], 'Registro exitoso');
                return;
            } else {
                (new Pages())->render('usuario/registro', [
                    'errores' => [
                        'registro' => 'El usuario ya existe o hubo un error al registrar.'
                    ],
                    'datos' => [
                        'usuario' => $datos['usuario']
                    ]
                ]);
                return;
            }
        } catch (\RuntimeException $e) {
            (new Pages())->render('usuario/registro', [
                'errores' => [
                    'registro' => 'Error al registrar el usuario: ' . $e->getMessage()
                ],
                'datos' => [
                    'usuario' => $datos['usuario']
                ]
            ]);
        }
    }
}
