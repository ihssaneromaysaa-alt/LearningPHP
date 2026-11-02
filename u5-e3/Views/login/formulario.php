<section class="tarjeta">
    <h1>Iniciar sesión</h1>
    <p class="ayuda">
        Usa credenciales ficticias. El formulario no usa <code>required</code>
        a propósito para que puedas probar qué pasa cuando falta algún campo.
    </p>

    <form method="post" action="index.php?controller=login&action=procesar">
        <div class="campo">
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario" autocomplete="off">
        </div>

        <div class="campo">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" autocomplete="off">
        </div>

        <button class="boton" type="submit">Iniciar sesión</button>
    </form>
</section>