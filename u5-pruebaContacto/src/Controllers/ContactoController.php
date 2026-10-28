<?php
declare(strict_types=1);
namespace Controllers;
use Lib\Pages;
use Models\Contacto;

class ContactoController{
    private Pages $page;
    public function __construct()
    {
        $this->page = new Pages();
    }
    public function formulario():void{
        $this->page->render('contacto/formulario');
    }
    public function procesar():void{
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            $this->formulario();
            return;
        }
        $contacto = Contacto::fromArray($_POST['contacto'] ?? []);
        $this->page->render('contacto/resultado', ['contacto' => $contacto]);
    }
}