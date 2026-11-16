<?php
declare(strict_types=1);

// Comprobar si existe la cookie
if (isset($_COOKIE['aceptar'])) {
    echo "<p>Has aceptado las cookies.</p>";
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aceptar'])) {

    // Crear la cookie durante una hora
    setcookie(
        'aceptar',
        'true',
        [
            'expires' => time() + 3600,
            'path' => '/',
            'httponly' => true,
            'secure' => false,
            'samesite' => 'Lax'
        ]
    );

    // Recargar la página para que PHP pueda leer la cookie
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Política de cookies</title>
</head>
<body>

    <h1>Política de cookies</h1>

    <?php if (!isset($_COOKIE['aceptar'])): ?>

        <p>Debes aceptar nuestra política de cookies para continuar.</p>

        <form method="post">
            <button type="submit" name="aceptar" value="true">
                Aceptar cookies
            </button>
        </form>

    <?php endif; ?>

</body>
</html>
