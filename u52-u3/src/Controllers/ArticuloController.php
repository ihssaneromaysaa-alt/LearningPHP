<?php
declare(strict_types=1);

namespace Controllers;

use Models\Articulo;
use lib\Pages;

// controla la búsqueda de artículos y decide qué vista mostrar
class ArticuloController
{
    private Articulo $modelo;

    public function __construct()
    {
        $this->modelo = new Articulo();
    }

    // muestra el formulario al entrar en la aplicación
    public function index(): void
    {
        http_response_code(200);
        Pages::render('articulo/buscar', ['idBuscado' => ''], 'buscar artículos');
    }

    // recibe, valida y busca el identificador enviado por get
    public function buscar(): void
    {
        $idTexto = $_POST['id'] ?? null;

        // comprueba que se haya enviado un identificador
        if ($idTexto === null || $idTexto === '') {
            http_response_code(400);
            Pages::render(
                'articulo/error400',
                [
                    'mensaje' => 'No has introducido ningún identificador.',
                    'idBuscado' => ''
                ],
                'solicitud incorrecta'
            );
            return;
        }

        // evita aceptar arrays u otros tipos de datos
        if (!is_string($idTexto)) {
            $this->mostrarError400('El identificador introducido no tiene un formato válido.', '');
            return;
        }

        $idTexto = trim($idTexto);

        // el identificador debe contener únicamente números y ser mayor que cero
        if (
            $idTexto === ''
            || preg_match('/^[0-9]+$/D', $idTexto) !== 1
            || filter_var($idTexto, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) === false
        ) {
            $this->mostrarError400(
                'El identificador debe ser un número entero positivo.',
                $idTexto
            );
            return;
        }

        $id = (int) $idTexto;
        $articulo = $this->modelo->buscarPorId($id);

        // si no existe, se envía el estado 404 antes de cargar la vista
        if ($articulo === null) {
            http_response_code(404);
            Pages::render(
                'articulo/no-encontrado',
                [
                    'idBuscado' => $idTexto
                ],
                'artículo no encontrado'
            );
            return;
        }

        http_response_code(200);
        Pages::render(
            'articulo/resultado',
            [
                'articulo' => $articulo,
                'idBuscado' => $idTexto
            ],
            'artículo encontrado'
        );
    }

    // centraliza la respuesta de los errores de validación
    private function mostrarError400(string $mensaje, string $idBuscado): void
    {
        http_response_code(400);
        Pages::render(
            'articulo/error400',
            [
                'mensaje' => $mensaje,
                'idBuscado' => $idBuscado
            ],
            'solicitud incorrecta'
        );
    }
}
