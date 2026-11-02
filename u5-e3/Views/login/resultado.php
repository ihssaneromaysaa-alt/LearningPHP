<section class="tarjeta">
    <h1>Qué ha recibido el servidor</h1>

    <table class="datos">
        <tr><th>Campo</th><th>¿Enviado?</th><th>¿Vacío?</th><th>Valor</th></tr>
        <?php foreach ($filas as $fila): ?>
            <tr>
                <td><?= $e($fila['campo']) ?></td>
                <td><?= $fila['enviado'] ? 'sí' : 'no' ?></td>
                <td><?= $fila['vacio'] ? 'sí' : 'no' ?></td>
                <td><?= $e($fila['valor']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php if ($faltan): ?>
        <div class="alerta alerta-error">
            Faltan datos: <strong><?= $e(implode(', ', $faltan)) ?></strong>.
        </div>
    <?php else: ?>
        <div class="alerta alerta-ok">
            Los dos campos han llegado correctamente (ejercicio didáctico: no se comprueba ningún usuario real).
        </div>
    <?php endif; ?>

    <p class="ayuda">
        En una aplicación real nunca se muestran las contraseñas ni se guardan en texto plano
        (se usa <code>password_hash()</code>).
    </p>

    <a class="boton" href="index.php?controller=login&action=formulario">Volver</a>
</section>