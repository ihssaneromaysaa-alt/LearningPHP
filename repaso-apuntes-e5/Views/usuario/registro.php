<section class="tarjeta">
    <h1>Registro de usuario</h1>
    <?php if (isset($errores['login'])): ?>
        <div class="alerta alerta-error"><?= e($errores['login']) ?></div>
    <?php endif; ?>
    <!-- novalidate: la validacion la hace el servidor -->
     <form method="post" action="/usuario/nuevoUsuario" novalidate>
        <div class="campo">
            <label>Email <input type="email" name="usuario[email]"
                value="<?= e($user['email'] ?? '') ?>" required></label>
            <?php if (isset($errores['email'])): ?>
                <div class="error-campo"><?= e($errores['email']) ?></div>
            <?php endif; ?>
        </div>

        <div class="campo">
            <label for="usuario">Usuario</label>
            <input type="text" 
            id="usuario" 
            name="usuario[usuario]" 
            autocomplete="off"
                class="<?= isset($errores['usuario']) ? 'invalido' : '' ?>"
                value="<?= e($datos['usuario'] ?? '') ?>">
            <?php if (isset($errores['usuario'])): ?>
                <div class="error-campo"><?= e($errores['usuario']) ?></div>
            <?php endif; ?>
        </div>

        <div class="campo">
            <label for="password">Contraseña</label>
            <!-- la contraseña nunca se vuelve a escribir en el value -->
            <input type="password" id="password" name="usuario[password]"  value="" autocomplete="off"
                   class="<?= isset($errores['password']) ? 'invalido' : '' ?>">
            <?php if (isset($errores['password'])): ?>
                <div class="error-campo"><?= e($errores['password']) ?></div>
            <?php endif; ?>
        </div>
        <div class="campo">
            <label for="password">Repita la contraseña</label>
            <!-- la contraseña nunca se vuelve a escribir en el value -->
            <input type="password" id="password" name="usuario[password2]"  value="" autocomplete="off"
                   class="<?= isset($errores['password']) ? 'invalido' : '' ?>">
            <?php if (isset($errores['password'])): ?>
                <div class="error-campo"><?= e($errores['password']) ?></div>
            <?php endif; ?>
        </div>
    
        <button class="boton" type="submit">Registrar</button>
    </form>
    <br>
    <form method="get" action="/" novalidate>
        <button class="boton" submit="">¿Tienes cuenta? Inicia sesión</button>
    </form>
</section>