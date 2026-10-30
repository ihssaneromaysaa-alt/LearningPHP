<h1>Nuevo contacto</h1>

<form action="index.php?controller=auth&action=formulario" method="post">
    <p>
        <label for="usuario">usuario:</label>
        <input type="text" name="usuario[usuario]">
        
    </p>
    <p>
        <label for="cont">contraseña:</label>
        <input type="password" name="usuario[password]">
    </p>
    <input type="submit" value="Enviar datos">
    <p>
        <?php if (!empty($errores['login'])): ?>
            <span class="error"><?= htmlspecialchars($errores['login']) ?></span>
        <?php endif; ?>
    </p>
</form>