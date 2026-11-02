<section class="tarjeta">
    <h1>Datos recibidos</h1>

    <table class="datos">
        <tr><th>Campo</th><th>Tipo en php</th><th>Valor</th></tr>
        <?php foreach ($filas as $fila): ?>
            <tr>
                <td><?= $e($fila['campo']) ?></td>
                <td><?= $e($fila['tipo']) ?></td>
                <td><?= $e($fila['valor']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php if ($coinciden): ?>
        <div class="alerta alerta-ok">Las dos contraseñas coinciden.</div>
    <?php else: ?>
        <div class="alerta alerta-error">Las contraseñas no coinciden o falta alguna.</div>
    <?php endif; ?>

    <a class="boton" href="index.php?controller=alumno&action=formulario">Volver al formulario</a>
</section>