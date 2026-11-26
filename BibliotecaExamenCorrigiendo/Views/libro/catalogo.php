<h1>Catálogo</h1>

<?php
// TODO (apartado 3): recibe la variable $libros (array de objetos Libro).
// Recórrela y pinta cada ficha reutilizando imprimeFicha.php.
// Si no hay libros, muestra «Todavía no hay libros en la biblioteca».

if(empty($libros ?? []))
    echo "Todavia no hay libros" ; // ?'
elseif(is_array($libros)){
    foreach($libros as $libro){
        ?>
        <article class="ficha">
            <img src="<?= RUTA_IMG . e($libro->portada ?? '' ) ?>" alt="<?= e($libro->portada ?? 'portada no definida') ?>">
            <h3><?= e($libro->titulo ?? 'título no definido') ?></h3>
            <p class="autor">Por: <?= e($libro->autor ?? 'autor o autora no definido/a') ?></p>
            <span class="genero"><?= e($titulo->genero ?? 'género no definido') ?></span>
        </article>
        <?php
    }
}
/*
src="/var/www/projects/bibliotecaexamen/public/img/follett.jpg"
C:\proyectos\docker-php\projects\BibliotecaExamen\public\img\follett.jpg
*/
?>

