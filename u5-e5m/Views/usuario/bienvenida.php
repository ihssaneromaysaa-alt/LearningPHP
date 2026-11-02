<section class="tarjeta">
    <h1>Bienvenido, <?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?></h1>
    <div class="alerta alerta-ok">Has iniciado sesión correctamente.</div>

    <a class="boton" href="index.php?controller=auth&action=salir">Cerrar sesión</a>
</section>