<?php

$tituloPagina = 'Listado de libros';

require VIEWS_PATH . '/layout/header.php';

?>

<h2 class="page-title">Listado de libros</h2>

<p class="page-description">
    Consulta todos los libros de nuestra biblioteca y sus autores.
</p>

<div class="table-container">

    <table>

        <thead>

            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Año</th>
                <th>Autor</th>
                <th>Disponibilidad</th>
                <th>Detalle</th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($libros as $libro): ?>

                <?php
                $autor = $autorRepositorio->getPorId(
                    $libro->getAutorId()
                );
                ?>

                <tr>

                    <td><?= $libro->getId() ?></td>

                    <td>
                        <?= htmlspecialchars($libro->getTitulo()) ?>
                    </td>

                    <td><?= $libro->getAnio() ?></td>

                    <td>
                        <?php if ($autor !== null): ?>

                            <a href="index.php?accion=autor&id=<?= $autor->getId() ?>">
                                <?= htmlspecialchars($autor->getNombre()) ?>
                            </a>

                        <?php else: ?>

                            Autor desconocido

                        <?php endif; ?>
                    </td>

                    <td>

                        <?php if ($libro->getDisponible()): ?>

                            <span class="disponible">Disponible</span>

                        <?php else: ?>

                            <span class="prestado">Prestado</span>

                        <?php endif; ?>

                    </td>

                    <td>
                        <a
                            class="btn-small"
                            href="index.php?accion=libro&id=<?= $libro->getId() ?>"
                        >
                            Ver libro
                        </a>
                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>

<?php

require VIEWS_PATH . '/layout/footer.php';

?>