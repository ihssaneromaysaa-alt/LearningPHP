<section class="tarjeta">
    <div class="alerta alerta-error">
        <h1>Solicitud incorrecta</h1>
        <p><?= $e($mensaje) ?></p>
    </div>

    <h2>Vuelve a intentarlo</h2>
    <?php require __DIR__ . '/_formulario.php'; ?>
</section>
