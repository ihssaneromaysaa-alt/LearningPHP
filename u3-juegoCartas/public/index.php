<?php

// use Enums\Palo;
// use Enums\Valor;
// use Models\Carta;
// use Models\Baraja;
// use Lib\Pages;
// use Controllers\BarajaController;

// $controller = new BarajaController();
// $controller->barajar();


declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../autoloader.php';

use Controllers\FrontController;

FrontController::main();









/*
$pages = new Pages();

$baraja = new Baraja();
$baraja->barajarCartas();
// Mostrar toda la baraja
$pages->render('baraja/muestraBaraja', [
    'cartas' => $baraja->getCartas(),
    'titulo' => 'Baraja completa'
]);*/
/*
// PRUEBAS
echo "<h1>Prueba de Baraja Española</h1>";

// Carta que sabemos que existe
$cartaPrueba = new Carta(Valor::Tres, Palo::Bastos);
echo "<h2>Carta de prueba (bastos_3)</h2>";
echo "Nombre: " . $cartaPrueba . "<br>";
echo "Imagen generada: <strong>" . $cartaPrueba->getImagen() . "</strong><br>";
echo "HTML generado:<br>";
$barajaTemp = new Baraja();
$barajaTemp->mostrarCarta($cartaPrueba);

echo "<hr>";

// Baraja completa
$baraja = new Baraja();
echo "<h2>Baraja completa (" . count($baraja->getCartas()) . " cartas)</h2>";

$baraja->barajarCartas();

echo "<h3>Sacando 8 cartas:</h3>";

for ($i = 1; $i <= 8; $i++) {
    $carta = $baraja->sacarCarta();
    if ($carta === null) {
        echo "No quedan más cartas";
        break;
    }
    echo $carta->getImagen() ;
    echo $carta;
    $baraja->mostrarCarta($carta);
    echo "<br>";
}
echo "<br><br>Cartas restantes: " . count($baraja->getCartas());

*/