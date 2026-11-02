<?php

$tituloPagina = 'Ficha del autor';

require VIEWS_PATH . '/layout/header.php';

?>

<h2 class="page-title">Ficha del autor</h2>

<?php if ($autor !== null): ?>

    <div class="detalle-card">

        <h3>
            <?= htmlspecialchars($autor->getNombre()) ?>
        </h3>

        <p>
            <strong>ID:</strong>
            <?= $autor->getId() ?>
        </p>

        <p>
            <strong>Nacionalidad:</strong>
            <?= htmlspecialchars($autor->getNacionalidad()) ?>
        </p>

        <h3 class="subtitulo">Libros del autor</h3>

        <?php if (!empty($libros)): ?>

            <div class="lista-libros">

                <?php foreach ($libros as $libro): ?>

                    <div class="libro-item">

                        <div>

                            <strong>
                                <?= htmlspecialchars($libro->getTitulo()) ?>
                            </strong>

                            <p>
                                Año: <?= $libro->getAnio() ?>
                            </p>

                        </div>

                        <a
                            class="btn-small"
                            href="index.php?accion=libro&id=<?= $libro->getId() ?>"
                        >
                            Ver detalle
                        </a>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <p>Este autor todavía no tiene libros registrados.</p>

        <?php endif; ?>

        <a href="index.php?accion=libros" class="btn">
            Volver a los libros
        </a>

    </div>

<?php else: ?>

    <div class="mensaje-error">
        El autor solicitado no existe.
    </div>

    <a href="index.php?accion=libros" class="btn">
        Volver al listado
    </a>

<?php endif; ?>

<?php

require VIEWS_PATH . '/layout/footer.php';

?>