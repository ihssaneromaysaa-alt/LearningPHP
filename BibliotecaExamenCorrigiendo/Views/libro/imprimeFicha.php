<?php
// TODO (apartado 2): vista de la ficha de un libro.
// Recibe la variable $libro (objeto Libro). Solo HTML y PHP para pintar.?>


<article class="ficha">
    <img src="<?= e($libro['portada'] ?? '' ) ?>" alt="<?= e($libro['portada'] ?? 'portada no definida') ?>">
    <h3><?= e($libro['titulo'] ?? 'título no definido') ?></h3>
    <p class="autor">Por: <?= e($libro['autor'] ?? 'autor o autora no definido/a') ?></p>
    <span class="genero"><?= e($titulo['genero'] ?? 'género no definido') ?></span>
</article>