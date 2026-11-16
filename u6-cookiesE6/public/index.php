<?php
declare(strict_types=1);

// BORRAR COOKIE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['borrar'])) {

    setcookie('visitas', '', [
        'expires' => time() - 3600,
        'path' => '/',
        'httponly' => true,
        'secure' => false,
        'samesite' => 'Lax'
    ]);

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// COMPROBAR SI EXISTE LA COOKIE
if (isset($_COOKIE['visitas'])) {
    $visitas = json_decode($_COOKIE['visitas'], true);
} else {
    $visitas = [];
}

// AÑADIR VISITA ACTUAL
$visitas[] = date('d/m/Y H:i:s');

// GUARDAR COOKIE
setcookie('visitas', json_encode($visitas), [
    'expires' => time() + 3600,
    'path' => '/',
    'httponly' => true,
    'secure' => false,
    'samesite' => 'Lax'
]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de visitas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="contenedor">
    <h1>Últimas visitas</h1>
    <?php if (count($visitas) > 0): ?>
        <ol>
            <?php
            for ($i = count($visitas) - 1; $i >= 0; $i--) {
                echo '<li>' . htmlspecialchars($visitas[$i]) . '</li>';
            }
            ?>
        </ol>
    <?php else: ?>
        <p>No hay visitas almacenadas.</p>
    <?php endif; ?>
    <form method="post">
        <button type="submit" name="borrar">
            Borrar historial
        </button>
    </form>
</div>
</body>
</html>
