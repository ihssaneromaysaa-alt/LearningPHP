<section class="tarjeta">
    <h1>Iniciar sesión</h1>
    <p class="ayuda">Credenciales de prueba: usuario <code>usuario</code> y clave <code>1234</code>.</p>

    <form method="post" action="index.php?controller=auth&action=formulario" novalidate>
        <div class="campo">
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario[usuario]" autocomplete="off"
                   class="<?= isset($errores['usuario']) ? 'invalido' : '' ?>"
                   value="<?= htmlspecialchars($datos['usuario'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            <?php if (isset($errores['usuario'])): ?>
                <div class="error-campo"><?= htmlspecialchars($errores['usuario'], ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>
        </div>

        <div class="campo">
            <label for="password">Contraseña</label>
            <!-- la contraseña nunca se vuelve a escribir en el value -->
            <input type="password" id="password" name="usuario[password]" autocomplete="off"
                   class="<?= isset($errores['password']) ? 'invalido' : '' ?>">
            <?php if (isset($errores['password'])): ?>
                <div class="error-campo"><?= htmlspecialchars($errores['password'], ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>
        </div>

        <button class="boton" type="submit">Iniciar sesión</button>
    </form>
</section>