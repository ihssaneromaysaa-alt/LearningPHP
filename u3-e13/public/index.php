
<?php

// 1. Incluir la clase
include '../src/PerfilJugador.php';

// Ruta del archivo donde guardaremos los datos
$ruta = '../datos/jugador.txt';

// 2. Crear una instancia
$jugador1 = new PerfilJugador("Gamer123", 9500);

// 3. Añadir algunos logs
$jugador1->agregarLog("Inició sesión.");
$jugador1->agregarLog("Superó el nivel 5.");

echo "<h2>1. Estado original del jugador</h2>";

echo "<pre>";
var_dump($jugador1);
echo "</pre>";

echo "<h3>Logs originales:</h3>";

echo "<pre>";
print_r($jugador1->getLog());
echo "</pre>";

// 4. Serializar el objeto
$serializado = serialize($jugador1);

echo "<h2>2. Objeto serializado</h2>";

echo "<pre>";
echo htmlspecialchars($serializado);
echo "</pre>";

// 5. Comprobar que no contiene el log temporal
echo "<h3>3. Comprobación del log</h3>";

if (strpos($serializado, '_logTemporal') === false) {
    echo "Correcto: el log temporal no se ha guardado.";
} else {
    echo "Error: el log temporal aparece en la serialización.";
}

// 6. Guardar el objeto en un archivo
file_put_contents($ruta, $serializado);

echo "<h2>4. Objeto guardado en archivo</h2>";

echo "Archivo jugador.txt creado correctamente.";

// 7. Leer el archivo y recuperar el objeto
$contenido = file_get_contents($ruta);

$jugador2 = unserialize($contenido);

// 8. Mostrar el objeto restaurado
echo "<h2>5. Estado del jugador restaurado</h2>";

echo "<pre>";
var_dump($jugador2);
echo "</pre>";

// Mostrar los logs del jugador restaurado
echo "<h3>Logs después de restaurar:</h3>";

echo "<pre>";
print_r($jugador2->getLog());
echo "</pre>";
