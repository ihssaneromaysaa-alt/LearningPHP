<?php
// index.php

// Cargamos los archivos de las clases
require_once __DIR__ . '/App/Modelos/Usuario.php';
require_once __DIR__ . '/App/Utilidades/Validador.php';

// Importamos las clases con la palabra clave "use"
use App\Modelos\Usuario;
use App\Utilidades\Validador;

// ===== Uso de las clases =====

$email1 = "ana@ejemplo.com";
$email2 = "correo-invalido";

// Validamos emails con el método estático
echo "Validando '$email1': ";
echo Validador::validarEmail($email1) ? "Válido<br>" : "No válido<br>";

echo "Validando '$email2': ";
echo Validador::validarEmail($email2) ? "Válido<br>" : "No válido<br>";

echo "<br>";

// Creamos un usuario solo si el email es válido
if (Validador::validarEmail($email1)) {
    $usuario = new Usuario("Ana García", $email1);
    $usuario->mostrarInfo();
} else {
    echo "No se puede crear el usuario porque el email no es válido.";
}