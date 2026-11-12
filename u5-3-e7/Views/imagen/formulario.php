<section class="tarjeta">
    <h1>Iniciar sesión</h1>
    <p class="ayuda">Credenciales de prueba: usuario <code>usuario</code> y clave <code>contra1234Ab_</code>.</p>

    <!-- novalidate: la validacion la hace el servidor -->
    <form method="post" action="index.php?controller=imagen&action=formulario" enctype="multipart/form-data" novalidate>
        <div class="campo">
            <label for="foto">Foto</label>
            <input type="file" id="foto" name="foto" accept="image/*"
                   class="<?= isset($errores['foto']) ? 'invalido' : '' ?>" autocomplete="off">
            <?php if (isset($errores['foto'])): ?>
                <div class="error-campo"><?= $e($errores['foto']) ?></div>
            <?php endif; ?>
        </div>
        

        <button class="boton" type="submit">Iniciar sesión</button>
    </form>
</section>