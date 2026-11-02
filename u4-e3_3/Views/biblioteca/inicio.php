<?php

$tituloPagina = 'Inicio - Tus Libros';

require VIEWS_PATH . '/layout/header.php';

?>

<section class="bienvenida">

    <div class="bienvenida-icono">
        
    </div>

    <h2>¡Bienvenido a Tus Libros!</h2>

    <p>
        Descubre nuestra biblioteca y consulta todos los libros
        disponibles y sus autores.
    </p>

    <a href="index.php?accion=libros" class="btn">
        Explorar libros
    </a>

</section>

<?php

require VIEWS_PATH . '/layout/footer.php';

?>