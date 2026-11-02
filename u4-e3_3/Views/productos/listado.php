
<?php

$tituloPagina = 'Catálogo de productos';

require VIEWS_PATH . '/layout/header.php';

?>

<h2 class="page-title">Catálogo de productos</h2>

<p class="page-description">
    Consulta todos los productos disponibles en nuestra tienda.
</p>

<!-- TABLA DE PRODUCTOS -->

<div class="table-container">

    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Precio con IVA</th>
                <th>Stock</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($productos as $producto): ?>

                <tr>

                    <td>
                        <?= $producto->getId() ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($producto->getNombre()) ?>
                    </td>

                    <td>
                        <?= number_format($producto->getPrecio(), 2, ',', '.') ?> €
                    </td>

                    <td>
                        <?= number_format($producto->getPrecioConIva(), 2, ',', '.') ?> €
                    </td>

                    <td>

                        <?php if ($producto->getStock() == 0): ?>

                            <span class="agotado">Agotado</span>

                        <?php else: ?>

                            <span class="stock">
                                <?= $producto->getStock() ?>
                            </span>

                        <?php endif; ?>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>

<!-- RESUMEN DEL INVENTARIO -->

<div class="resumen">

    <div class="resumen-card">

        <h3>Total de productos</h3>

        <p><?= $totalProductos ?></p>

    </div>

    <div class="resumen-card">

        <h3>Valor total del inventario</h3>

        <p>
            <?= number_format($valorTotalInventario, 2, ',', '.') ?> €
        </p>

    </div>

</div>

<?php

require VIEWS_PATH . '/layout/footer.php';

?>
