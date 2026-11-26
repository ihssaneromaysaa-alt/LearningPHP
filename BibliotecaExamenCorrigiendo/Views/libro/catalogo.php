<h1>Catálogo</h1>


<?php
if (empty($libros)): ?>
    <p>Todavía no hay libros en la biblioteca.</p>
<?php else: ?>
    <?php foreach ($libros as $libro): ?>
        <?php require __DIR__ . '/imprimeFicha.php'; ?>
    <?php endforeach; ?>
<?php endif;
/*
src="/var/www/projects/bibliotecaexamen/public/img/follett.jpg"
C:\proyectos\docker-php\projects\BibliotecaExamen\public\img\follett.jpg
*/
?>

