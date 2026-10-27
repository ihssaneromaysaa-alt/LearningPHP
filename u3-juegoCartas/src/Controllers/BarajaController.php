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
    /*
    public function sacarCarta(string $palo, int $numero){
        $resultado = isset($_POST["palo"]) && isset($_POST["numero"]) ? $_POST["palo"]. " " .$_POST["numero"] : "null";
        ($resultado === null)?$carta = new Carta($_POST["numero"], $_POST["palo"]) : "";


        function comprobarPassword(string $contrasenia)
        {
            $arrayRegex = [
                '/^.{6,15}$/',
                '/[0-9]/',
                '/[a-z]/',
                '/[A-Z]/',
                '/[^a-zA-Z0-9]/'
            ];
            
            $cumple = true;

            foreach ($arrayRegex as $regex) {
                if (!preg_match($regex, $contrasenia)) 
                    $cumple = false;
            }
            return $cumple;
        }

        function imprimirPassValido (bool $isValid){
            $respuesta = "";
            if($isValid) 
                $respuesta = "Contraseña Valida";
            else
                $respuesta = "Contraseña Invalida";

            return $respuesta;
        }

    }
*/
}