<?php
declare(strict_types=1);

include_once __DIR__ . '/Dado.php';

// si pulsamos el botón
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tirar'])) {

    $dados = [];

    for ($i = 0; $i < 5; $i++) {
        $dado = new Dado();
        $dado->tirar();
        $dados[] = $dado->sacarUltimaCara();
    }

    setcookie('dados', json_encode($dados), [
        'expires' => time() + 3600,
        'path' => '/',
        'httponly' => true,
        'secure' => false,
        'samesite' => 'Lax'
    ]);

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Dados</title>
</head>
<body>

<?php
// Si existe la cookie, mostramos los dados
if (isset($_COOKIE['dados'])) {

    $dados = json_decode($_COOKIE['dados'], true);

    echo "Los dados sacados:<br>";

    foreach ($dados as $cara) {
        echo '<img src="/img/' . htmlspecialchars($cara) . '.JPG">';
    }
}
?>

<form method="post">
    <button type="submit" name="tirar">
        Tirar dados
    </button>
</form>

</body>
</html>
