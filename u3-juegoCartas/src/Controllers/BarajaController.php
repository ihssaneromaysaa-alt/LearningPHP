<?php

declare(strict_types=1);
namespace Controllers;

use Models\Carta;
use Models\Baraja;
use Lib\Pages;

class BarajaController{
    private Pages $pages;
    private Baraja $baraja;

    public function __construct(){
        $this->pages = new Pages();
        $this->baraja = new Baraja();

    }
    public function muestraBaraja(): void{
        $this->mostrarCartas($this->baraja->getCartas(), 'Baraja completa');
    }
    public function barajar():void{
        $this->baraja->barajarCartas();
        $this->mostrarCartas($this->baraja->getCartas(),'Baraja mezclada');
    }
    private function mostrarCartas(array $cartas, string $titulo){
        $this->pages->render('baraja/muestraBaraja',[
            'cartas' => $cartas,
            'titulo' => $titulo
        ]);
    }
    public function mostrarCarta(): void{
        $carta = $this->baraja->sacarCarta();

        if ($carta === null) {
            $this->pages->render('baraja/muestraBaraja', [
                'cartas' => [],
                'titulo' => 'No quedan cartas'
            ]);
            return;
        }

        $this->pages->render('baraja/muestraBaraja', [
            'cartas' => [$carta],
            'titulo' => 'Carta extraída'
        ]);
    }
}