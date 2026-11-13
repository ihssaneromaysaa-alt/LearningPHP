<?php
declare(strict_types=1);

namespace Controllers;

use Core\Pages;
use Models\Contacto;
use Requests\ContactoRequest;

final class ContactoController
{
    private Pages $pagina;

    public function __construct()
    {
        $this->pagina = new Pages();
    }

    /** Muestra el formulario inicial por primera vez (GET) */
    public function formulario(): void
    {
        $this->pagina->render('contacto/formulario', [
            'contacto' => new Contacto(metodosPago: ['VISA']),
            'metodos'  => ContactoRequest::METODOS_PAGO,
            'errores'  => [],
        ]);
    }

    /** Procesa el formulario (POST) sin usar sesiones ni redirecciones */
    public function procesar(): void
    {
        //if ($_SERVER['REQUEST_METHOD'] !== 'POST')  esto ya no se necesita
        $entrada = $_POST['contacto'] ?? [];
        $request = new ContactoRequest(is_array($entrada) ? $entrada : []);

        // Si los datos NO son válidos, renderizamos de nuevo el formulario con los datos recibidos y los errores
        if (!$request->esValido()) {
            $this->pagina->render('contacto/formulario', [
                'contacto' => Contacto::fromArray($request->datos()),
                'metodos'  => ContactoRequest::METODOS_PAGO,
                'errores'  => $request->errores(),
            ]);
            return;
        }

        // Si los datos son válidos, renderizamos la vista del resultado
        $contacto = Contacto::fromArray($request->datos());
        $this->pagina->render('contacto/resultado', ['contacto' => $contacto]);
    }
}
