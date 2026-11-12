<section class="tarjeta">
    <div class="alerta alerta-error">
        <h1>Artículo no encontrado</h1>
        <p>Lo sentimos, el artículo que estás buscando no existe.</p>
        <p>Identificador consultado: <?= $e($idBuscado) ?></p>
    </div>

    <h2>Inténtalo de nuevo</h2>
    <?php require __DIR__ . '/_formulario.php'; ?>
</section>
