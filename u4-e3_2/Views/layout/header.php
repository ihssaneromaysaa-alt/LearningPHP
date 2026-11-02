
<?php
$tituloPagina = $tituloPagina ?? 'Catálogo de productos';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($tituloPagina) ?></title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <header class="header">

        <div class="header-container">

            <div class="logo">
                <h1>MiTienda</h1>
            </div>

            <nav class="nav">
                <a href="index.php">Inicio</a>
                <a href="index.php">Productos</a>
            </nav>

        </div>

    </header>

    <main class="container">
