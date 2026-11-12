<?php
declare(strict_types=1);

// Verificar si la cookie ya existe
if (isset($_COOKIE['aceptar'])) {
    // Mostrar mensaje de confirmación si la cookie ya fue aceptada
    echo "<p>Has aceptado las cookies. Preferencia guardada: " . htmlspecialchars($_COOKIE['aceptar']) . "</p>";
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aceptar'])) {
    // Validar y sanitizar el valor de la cookie
    $cookieValue = ($_POST['aceptar'] === 'true') ? 'true' : 'false';

    // establecer la cookie con opciones seguras
    setcookie(
        'aceptar',                // nombre de la cookie
        $cookieValue,             // valor
        [
            'expires' => time() + 3600, // 1 hora
            'path' => '/',
            'domain' => '',       // especifica tu dominio si es necesario
            'httponly' => true,
            'secure' => true,     // solo si usas HTTPS
            'samesite' => 'Lax'
        ]
    );
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aceptar las condiciones</title>
</head>
<body>
    <h1>Gestión de cookies</h1>

    <?php
    // mostrar mensaje si no se ha aceptado aún
    if (!isset($_COOKIE['aceptar'])) {
        echo "<p>Debes aceptar las cookies para continuar.</p>";
    }
    ?>

    <form method="post" action="">
        <label for="aceptar">
            Elige una preferencia:
        </label>
        <br>
        <input name="aceptar" id="aceptar_true" value="true" type="radio" <?php echo (isset($_COOKIE['aceptar']) && $_COOKIE['aceptar'] === 'true') ? 'checked' : ''; ?>> Sí
        <br>
        <input name="aceptar" id="aceptar_false" value="false" type="radio" <?php echo (isset($_COOKIE['aceptar']) && $_COOKIE['aceptar'] === 'false') ? 'checked' : ''; ?>> No
        <br>
        <button type="submit">Guardar preferencia</button>
    </form>
</body>
</html>
