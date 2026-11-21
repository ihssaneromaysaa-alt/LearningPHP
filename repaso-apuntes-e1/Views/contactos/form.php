<h1>Acceso</h1>
<?php if (!empty($error)): ?>
    <p style="color:#b00020"><strong><?= e($error) ?></strong></p>
<?php endif; ?>
<?php if (!empty($info)): ?>
    <p style="color:#0a6b0a"><?= e($info) ?></p>
<?php endif; ?>

<form method="post" action="<?= (url('guardar')) ?>">
    <p><label>nombre</label>
        <input type="text" name="user[nombre]" 
        value="<?= htmlspecialchars($user['nombre'] ?? '') ?>" required></input>
        <?php if (!empty($errores['nombre'])): ?>
            <span class="error"><?= htmlspecialchars($errores['nombre']) ?></span>
        <?php endif; ?>
    </p>
    <p><label>telefono <input type="number" name="user[telefono]"
    value="<?= htmlspecialchars($user['telefono'] ?? '') ?>" required></label>
        <?php if (!empty($errores['telefono'])): ?>
            <span class="error"><?= htmlspecialchars($errores['telefono']) ?></span>
        <?php endif; ?>
    </p>
    <p><label>email <input type="email" name="user[email]"
    value="<?= htmlspecialchars($user['email'] ?? '') ?>" required></label>
        <?php if (!empty($errores['email'])): ?>
            <span class="error"><?= htmlspecialchars($errores['email']) ?></span>
        <?php endif; ?>
    </p>
    <p><button type="submit">entrar</button></p>
</form>
