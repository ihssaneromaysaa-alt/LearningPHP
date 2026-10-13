<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Objeto Cartas</title>
</head>
<body>
    <?php
    require_once __DIR__ . '/src/Carta.php';

    try {
        $carta = new Carta(1, "ESPADAS");   // 1 = "as"
        echo $carta->toString();            // → "as de ESPADAS"
    } catch (InvalidArgumentException $e) {
        echo "ERROR: " . $e->getMessage();
    }

    ?>
</body>
</html>