<?php
// TODO (apartado 2): vista de la ficha de un libro.
// Recibe la variable $libro (objeto Libro). Solo HTML y PHP para pintar.?>

<article class="ficha">
    <img src="<?= e(BASE_URL . 'img/' . ($libro->portada ?? '')) ?>"
         alt="<?= e($libro->titulo ?? 'portada') ?>">
    <h3><?= e($libro->titulo ?? 'título no definido') ?></h3>
    <p class="autor">Por: <?= e($libro->autor ?? 'autor no definido') ?></p>
    <span class="genero"><?= e($libro->genero ?? 'género no definido') ?></span>
</article>