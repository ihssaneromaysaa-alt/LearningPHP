<?php
declare(strict_types=1);
/**
 * 
 * 3. Color de fondo
 * Crea una página web con un formulario para elegir el color de fondo. Almacena la elección del usuario con una 
 * cookie para que la siguiente vez que el usuario se conecte a la página aparezca directamente con ese color.
 */
if (isset($_COOKIE['colorFondo'])) {
    // Ya tiene preferencia guardada
    $preferencia = $_COOKIE['colorFondo'];
} else {
    // No tiene nada → valor por defecto
    $preferencia = 'white';
}
if (isset($_POST['colorFondo'])) {
    $preferencia = $_POST['colorFondo']; // lo que eligió ahora
}

setcookie(
    'colorFondo',                // nombre de la cookie
    $preferencia,                // valor
    [
        'expires' => time() + 3600, // 1 hora
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax'
    ]
);

/**
 * Determina si un color hexadecimal es oscuro o claro.
 *
 * @param string $hexColor Código hexadecimal del color (ej: "#3A5F8E" o "3A5F8E").
 * @return bool True si es oscuro, false si es claro.
 */
function esColorOscuro(string $hexColor): bool {
    // Eliminar el símbolo # si existe
    $hexColor = ltrim($hexColor, '#');

    // Convertir hexadecimal a valores RGB (0-255)
    $r = hexdec(substr($hexColor, 0, 2));
    $g = hexdec(substr($hexColor, 2, 2));
    $b = hexdec(substr($hexColor, 4, 2));

    // Calcular la luminosidad (Lightness) en HSL
    $max = max($r, $g, $b);
    $min = min($r, $g, $b);
    $lightness = (($max + $min) / 2) / 2.55; // Convertir a porcentaje (0-100)

    // Si la luminosidad es <= 50%, el color es oscuro
    return $lightness <= 50;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selector de color de fondo</title>
</head>
<body style='background-color:<?= $preferencia ?>;
             color: <?= esColorOscuro($preferencia) ? "white" : "black" ?>;'>
    <h1>Tu color de fondo es: <?= htmlspecialchars($preferencia) ?></h1>
    <form method="post">
        <label for="colorFondo">
            Elige un color de fondo:
        </label>
        <input name="colorFondo" type="color" value="<?= htmlspecialchars($preferencia) ?>">
        <button type="submit">Guardar preferencia</button>
    </form>
</body>
</html>
