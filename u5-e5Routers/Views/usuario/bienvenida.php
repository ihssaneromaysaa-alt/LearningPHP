<section class="tarjeta">
    <h1>
        Bienvenido <?= htmlspecialchars($usuario, ENT_QUOTES, 'UTF-8') ?>
    </h1>

    <div class="alerta alerta-ok">
        Has iniciado sesión correctamente.
    </div>

    <a class="boton" href="nuevo">
        Volver al formulario
    </a>
</section>