<?php
declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    $usuario = $_POST['user'] ?? '';
    $duracion = (int)($_POST['duration'] ?? 0);
    if($duracion >= 1 && $duracion <= 60){
        setcookie('crear', $usuario, [
            'expires' => time() + $duracion,
            'path' => '/',
            'httponly' => true,
            'secure' => false,
            'samesite' => 'Lax'
        ]); 
        // recargar la página para que PHP pueda leer la cookie
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

// actualizar
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])){
    $usuario = $_POST['user'] ?? '';
    $duracion = (int)($_POST['duration'] ?? 0);
    if($duracion >= 1 && $duracion <= 60)
    setcookie('crear', $usuario, [
            'expires' => time() + $duracion,
            'path' => '/',
            'httponly' => true,
            'secure' => false,
            'samesite' => 'Lax'
        ]); 
}

// comprobar si existe la cookie
if (isset($_COOKIE['crear']) && isset($_POST['borrar'])) {
    setcookie('crear', '', [
            'expires' => time() - 3600,
            'path' => '/',
            'httponly' => true,
            'secure' => false,
            'samesite' => 'Lax'
        ]); 
} 

if(isset($_COOKIE['crear']))
    var_dump($_COOKIE['crear']);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Creación y destruccion de cookies</title>
</head>
<body>

    <h1>Creación y destruccion de cookies</h1>
    <form method="post">
        Nombre de usuario: <input type="text" name="user"><br>
        Duración cookie (entre 1 y 60 segundos): <input type="number" name="duration">
        <br>
        <button type="submit" name="crear">
            Crear cookie
        </button>
        <button type="" name="actualizar">
            Actualizar cookie
        </button>
        <button type="" name="actualizar">
            Borrar cookie
        </button>
    </form>

    <?php if (!isset($_COOKIE['crear'])): ?>
        <p>¡No hay ninguna cookie almacenada!</p>
    <?php endif; ?>

</body>
</html>
