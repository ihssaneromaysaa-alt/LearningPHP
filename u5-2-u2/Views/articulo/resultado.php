<section class="tarjeta">
    <div class="alerta alerta-ok">Artículo encontrado correctamente.</div>
    <h1>Información del artículo</h1>

    <table class="datos">
        <tr>
            <th>ID</th>
            <td><?= $e($articulo['id']) ?></td>
        </tr>
        <tr>
            <th>Nombre</th>
            <td><?= $e($articulo['nombre']) ?></td>
        </tr>
        <tr>
            <th>Descripción</th>
            <td><?= $e($articulo['descripcion']) ?></td>
        </tr>
        <tr>
            <th>Precio</th>
            <td><?= $e(number_format((float) $articulo['precio'], 2, ',', '.')) ?> €</td>
        </tr>
    </table>

    <h2>Buscar otro artículo</h2>
    <?php require __DIR__ . '/_formulario.php'; ?>
</section>
