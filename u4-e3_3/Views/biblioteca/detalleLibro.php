<?php

$tituloPagina = 'Detalle del libro';

require VIEWS_PATH . '/layout/header.php';

?>

<h2 class="page-title">Detalle del libro</h2>

<?php if ($libro !== null): ?>

    <div class="detalle-card">

        <h3>
            <?= htmlspecialchars($libro->getTitulo()) ?>
        </h3>

        <p>
            <strong>ID:</strong>
            <?= $libro->getId() ?>
        </p>

        <p>
            <strong>Año de publicación:</strong>
            <?= $libro->getAnio() ?>
        </p>

        <p>
            <strong>Autor:</strong>

            <?php if ($autor !== null): ?>

                <a href="index.php?accion=autor&id=<?= $autor->getId() ?>">
                    <?= htmlspecialchars($autor->getNombre()) ?>
                </a>

            <?php else: ?>

                Autor desconocido

            <?php endif; ?>

        </p>

        <p>
            <strong>Disponibilidad:</strong>

            <?php if ($libro->getDisponible()): ?>

                <span class="disponible">Disponible</span>

            <?php else: ?>

                <span class="prestado">Prestado</span>

            <?php endif; ?>

        </p>

        <a href="index.php?accion=libros" class="btn">
            Volver al listado
        </a>

    </div>

<?php else: ?>

    <div class="mensaje-error">
        El libro solicitado no existe.
    </div>

    <a href="index.php?accion=libros" class="btn">
        Volver a los libros
    </a>

<?php endif; ?>

<?php

require VIEWS_PATH . '/layout/footer.php';

?>