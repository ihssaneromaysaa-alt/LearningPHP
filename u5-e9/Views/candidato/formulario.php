<?php if ($enviado && !$errores): ?>

<section class="tarjeta">
    <h1>Candidatura recibida</h1>
    <div class="alerta alerta-ok">Todos los datos son válidos.</div>

    <table class="datos">
        <tr><th>Nombre</th><td><?= $e($candidato['nombre']) ?></td></tr>
        <tr><th>Apellidos</th><td><?= $e($candidato['apellidos']) ?></td></tr>
        <tr><th>Correo</th><td><?= $e($candidato['correo']) ?></td></tr>
        <tr><th>Teléfono</th><td><?= $e($candidato['telefono']) ?></td></tr>
        <tr><th>Situación laboral</th><td><?= $e($situaciones[$candidato['situacion']]) ?></td></tr>
        <tr><th>Lenguajes</th><td><?= $e(implode(', ', $candidato['lenguajes'])) ?></td></tr>
        <tr><th>Trabajo anterior</th><td><a href="<?= $e($candidato['url']) ?>" target="_blank" rel="noopener noreferrer"><?= $e($candidato['url']) ?></a></td></tr>
    </table>

    <a class="boton" href="index.php?controller=candidato&action=formulario">Nueva candidatura</a>
</section>

<?php else: ?>

<section class="tarjeta">
    <h1>Candidatura a un puesto</h1>

    <?php if ($enviado && $errores): ?>
        <div class="alerta alerta-error">
            Se han detectado errores:
            <ul>
                <?php foreach ($errores as $mensaje): ?>
                    <li><?= $e($mensaje) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <?php if ($validos): ?>
            <div class="alerta alerta-ok">
                Campos correctos: <?= $e(implode(', ', array_keys($validos))) ?>.
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <form method="post" action="index.php?controller=candidato&action=formulario" novalidate>
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre"
                   class="<?= isset($errores['nombre']) ? 'invalido' : '' ?>"
                   value="<?= $e($candidato['nombre']) ?>">
            <?php if (isset($errores['nombre'])): ?><div class="error-campo"><?= $e($errores['nombre']) ?></div><?php endif; ?>
        </div>

        <div class="campo">
            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos"
                   class="<?= isset($errores['apellidos']) ? 'invalido' : '' ?>"
                   value="<?= $e($candidato['apellidos']) ?>">
            <?php if (isset($errores['apellidos'])): ?><div class="error-campo"><?= $e($errores['apellidos']) ?></div><?php endif; ?>
        </div>

        <div class="campo">
            <label for="correo">Correo electrónico</label>
            <input type="text" id="correo" name="correo"
                   class="<?= isset($errores['correo']) ? 'invalido' : '' ?>"
                   value="<?= $e($candidato['correo']) ?>">
            <?php if (isset($errores['correo'])): ?><div class="error-campo"><?= $e($errores['correo']) ?></div><?php endif; ?>
        </div>

        <div class="campo">
            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono"
                   class="<?= isset($errores['telefono']) ? 'invalido' : '' ?>"
                   value="<?= $e($candidato['telefono']) ?>">
            <?php if (isset($errores['telefono'])): ?><div class="error-campo"><?= $e($errores['telefono']) ?></div><?php endif; ?>
        </div>

        <div class="campo">
            <label>Situación laboral actual</label>
            <div class="opciones">
                <?php foreach ($situaciones as $clave => $texto): ?>
                    <label>
                        <input type="radio" name="situacion" value="<?= $e($clave) ?>"
                            <?= $candidato['situacion'] === $clave ? 'checked' : '' ?>>
                        <?= $e($texto) ?>
                    </label>
                <?php endforeach; ?>
            </div>
            <?php if (isset($errores['situacion'])): ?><div class="error-campo"><?= $e($errores['situacion']) ?></div><?php endif; ?>
        </div>

        <div class="campo">
            <label>Lenguajes de programación que dominas</label>
            <div class="opciones">
                <?php foreach ($lenguajes as $lenguaje): ?>
                    <label>
                        <input type="checkbox" name="lenguajes[]" value="<?= $e($lenguaje) ?>"
                            <?= in_array($lenguaje, $candidato['lenguajes'], true) ? 'checked' : '' ?>>
                        <?= $e($lenguaje) ?>
                    </label>
                <?php endforeach; ?>
            </div>
            <?php if (isset($errores['lenguajes'])): ?><div class="error-campo"><?= $e($errores['lenguajes']) ?></div><?php endif; ?>
        </div>

        <div class="campo">
            <label for="url">URL de un trabajo anterior</label>
            <input type="text" id="url" name="url" placeholder="https://ejemplo.com"
                   class="<?= isset($errores['url']) ? 'invalido' : '' ?>"
                   value="<?= $e($candidato['url']) ?>">
            <?php if (isset($errores['url'])): ?><div class="error-campo"><?= $e($errores['url']) ?></div><?php endif; ?>
        </div>

        <button class="boton" type="submit">Enviar candidatura</button>
    </form>
</section>

<?php endif; ?>