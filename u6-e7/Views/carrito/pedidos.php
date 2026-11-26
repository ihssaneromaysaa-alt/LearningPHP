<h1 class="carrito-titulo">El contenido de la cesta de la compra es:</h1>

<?php if (empty($cesta)): ?>
    <p class="carrito-vacio">La cesta está vacía.</p>
<?php else: ?>
    <table class="tabla-carrito">
        <thead>
            <tr>
                <th>Artículo</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cesta as $articulo => $cantidad): ?>
                <tr>
                    <td><?= e($articulo) ?></td>
                    <td><?= $cantidad ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a href="<?= e(BASE_URL . '/') ?>" class="volver">← Volver al carrito</a>