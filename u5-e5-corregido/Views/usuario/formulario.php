<section class="tarjeta">
    <h1>Iniciar sesión</h1>
    <?php if (isset($errores['login'])): ?>
        <div class="alerta alerta-error"><?= $e($errores['login']) ?></div>
    <?php endif; ?>
    <p class="ayuda">Credenciales de prueba: usuario <code>usuario</code> y clave <code>contra1234Ab_</code>.</p>

    <!-- novalidate: la validacion la hace el servidor -->
    <form method="post" action="index.php?controller=auth&action=formulario" novalidate>
        <div class="campo">
            <label for="usuario">Usuario</label>
            <input type="text" 
            id="usuario" 
            name="usuario[usuario]" 
            autocomplete="off"
                class="<?= isset($errores['usuario']) ? 'invalido' : '' ?>"
                value="<?= $e($datos['usuario'] ?? '') ?>">
            <?php if (isset($errores['usuario'])): ?>
                <div class="error-campo"><?= $e($errores['usuario']) ?></div>
            <?php endif; ?>
        </div>

        <div class="campo">
            <label for="password">Contraseña</label>
            <!-- la contraseña nunca se vuelve a escribir en el value -->
            <input type="password" id="password" name="usuario[password]"  value="" autocomplete="off"
                   class="<?= isset($errores['password']) ? 'invalido' : '' ?>">
            <?php if (isset($errores['password'])): ?>
                <div class="error-campo"><?= $e($errores['password']) ?></div>
            <?php endif; ?>
        </div>

        <button class="boton" type="submit">Iniciar sesión</button>
    </form>
</section>