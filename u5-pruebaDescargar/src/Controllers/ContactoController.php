<?php
declare(strict_types=1);

namespace Controllers;

use Lib\Pages;
use Models\Contacto;
use Requests\ContactoRequests;

class ContactoController
{
    private Pages $page;

    public function __construct()
    {
        $this->page = new Pages();
    }

    public function formulario(): void
    {
        // Por defecto sin datos ni errores (primera carga o GET)
        $this->page->render('contacto/formulario', [
            'errores' => [],
            'datos'   => [],
        ]);
    }

    public function descargar(): void{
        $fichero = dirname(__DIR__, 2) . '/public/assets/chandelier_sia.pdf';

        if (!is_file($fichero)) {
            http_response_code(404);
            echo 'El archivo PDF no existe.';
            exit;
        }

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="informe_anual_2026.pdf"');
        header('Content-Length: ' . filesize($fichero));

        readfile($fichero);
        exit;
    }

    public function procesar(): void{
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->formulario();
            return;
        }

        $entrada = $_POST['contacto'] ?? [];
        $request = new ContactoRequests(is_array($entrada) ? $entrada : []);

        if (!$request->esValido()) {
            $this->page->render('contacto/formulario', [
                'errores' => $request->errores(),
                'datos'   => $request->datos(),
            ]);
            return;
        }

        $contacto = Contacto::fromArray($request->datos());
        $this->page->render('contacto/resultado', ['contacto' => $contacto]);
    }

    // Ya no hace falta el redirect si no usas sesiones.
    // Lo dejo por si lo usas en otro sitio, pero no se usa aquí.
    public function redirigir(string $ruta): never{
        header('Location: index.php?controller=contacto&action=' . $ruta);
        exit;
    }
}