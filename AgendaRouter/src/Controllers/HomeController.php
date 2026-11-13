<?php
declare(strict_types=1);

namespace Controllers;
use Core\Pages;
class HomeController
{
    private Pages $pagina;
    public function __construct()
    {
        $this->pagina = new Pages();
    }
    public function index(){
            $this->pagina->render('home/index');
    }
}