<?php
declare(strict_types=1);

// 1. Determinamos el idioma
if (isset($_POST['idioma'])) {
    $idioma = $_POST['idioma'];
} elseif (isset($_COOKIE['idioma'])) {
    $idioma = $_COOKIE['idioma'];
} else {
    $idioma = 'español';
}

// 2. Guardamos la cookie
setcookie(
    'idioma',
    $idioma,
    [
        'expires'  => time() + 3600,
        'path'     => '/',
        'httponly' => true,
        'samesite' => 'Lax'
    ]
);

// 3. Textos según el idioma
$textos = [
    'español' => [
        'titulo'     => 'Selector de idioma',
        'mensaje'    => 'El idioma actual es',
        'elige'      => 'Elige un idioma:',
        'español'    => 'Español',
        'ingles'     => 'Inglés',
        'ruso'       => 'Ruso',
        'guardar'    => 'Guardar idioma',
        'bienvenida' => '¡Bienvenido a nuestra página!'
    ],
    'ingles' => [
        'titulo'     => 'Language selector',
        'mensaje'    => 'The current language is',
        'elige'      => 'Choose a language:',
        'español'    => 'Spanish',
        'ingles'     => 'English',
        'ruso'       => 'Russian',
        'guardar'    => 'Save language',
        'bienvenida' => 'Welcome to our website!'
    ],
    'ruso' => [
        'titulo'     => 'Выбор языка',
        'mensaje'    => 'Текущий язык',
        'elige'      => 'Выберите язык:',
        'español'    => 'Испанский',
        'ingles'     => 'Английский',
        'ruso'       => 'Русский',
        'guardar'    => 'Сохранить язык',
        'bienvenida' => 'Добро пожаловать на наш сайт!'
    ]
];

// Si por algún motivo el idioma no existe, usamos español
$t = $textos[$idioma] ?? $textos['español'];
?>

<!DOCTYPE html>
<html lang="<?= $idioma === 'ingles' ? 'en' : ($idioma === 'ruso' ? 'ru' : 'es') ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $t['titulo'] ?></title>
</head>
<body>

    <h1><?= $t['bienvenida'] ?></h1>

    <h2><?= $t['mensaje'] ?>: <strong><?= $t[$idioma] ?></strong></h2>

    <form method="post">
        <p><?= $t['elige'] ?></p>

        <label>
            <input type="radio" name="idioma" value="español"
                <?= $idioma === 'español' ? 'checked' : '' ?>>
            <?= $t['español'] ?>
        </label><br>

        <label>
            <input type="radio" name="idioma" value="ingles"
                <?= $idioma === 'ingles' ? 'checked' : '' ?>>
            <?= $t['ingles'] ?>
        </label><br>

        <label>
            <input type="radio" name="idioma" value="ruso"
                <?= $idioma === 'ruso' ? 'checked' : '' ?>>
            <?= $t['ruso'] ?>
        </label><br><br>

        <input type="submit" value="<?= $t['guardar'] ?>">
    </form>

</body>
</html>