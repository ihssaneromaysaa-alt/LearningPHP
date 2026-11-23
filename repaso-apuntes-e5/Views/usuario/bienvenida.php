<section class="tarjeta">
    <h1>
        Bienvenido <?= htmlspecialchars($usuario, ENT_QUOTES, 'UTF-8') ?>
    </h1>

    <div class="alerta alerta-ok">
        Has iniciado sesión correctamente.
        <br>
        <a href="/form/viviendas">
            Ir al formulario de inserción de viviendas
        </a>
    </div>

    <a class="boton" href="/">
        Volver al formulario
    </a>
</section>