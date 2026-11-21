<h1>Agenda de contactos</h1>
<table>
    <thead>
        <tr>
            <th>nombre</th>
            <th>telefono</th>
            <th>email</th>
        </tr>
    </thead>
    <?php if(isset($user)): ?>
    <?php foreach ($user as $usuario): ?>
        <tr>
            <td><?= htmlspecialchars($usuario['nombre']) ?></td>
            <td><?= htmlspecialchars($usuario['telefono']) ?></td>
            <td><?= htmlspecialchars($usuario['email']) ?></td>
        </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</table>
<br>
<form action="<?= (url('vaciar')) ?>" method="post"
    onsubmit="return confirm('¿Seguro que quieres vaciar la agenda?');">
    <p>parar vaciar la agenda</p>
    <button type="submit">vaciar agenda</button>
</form>
