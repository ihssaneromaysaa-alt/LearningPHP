<?php

$tituloPagina = 'Libros disponibles';

require VIEWS_PATH . '/layout/header.php';

?>

<h2 class="page-title">Libros disponibles</h2>

<p class="page-description">
    Estos son los libros que puedes encontrar disponibles en nuestra biblioteca.
</p>

<div class="table-container">

    <table>

        <thead>

            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Año</th>
                <th>Autor</th>
                <th>Detalle</th>
            </tr>

        </thead>

        <tbody>

            <?php if (!empty($libros)): ?>

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
                            <?= $autor !== null
                                ? htmlspecialchars($autor->getNombre())
                                : 'Autor desconocido' ?>
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

            <?php else: ?>

                <tr>
                    <td colspan="5">
                        No hay libros disponibles.
                    </td>
                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>

<?php

require VIEWS_PATH . '/layout/footer.php';

?>