<h1>Agenda de contactos</h1>
<p>Funciona el router.</p>
<table>
    <thead>
        <tr>
            <th>nombre</th>
            <th>telefono</th>
            <th>email</th>
        </tr>
    </thead>
    <?php if(isset($usuarios)): ?>
    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <th><?= $e($usuario['nombre']) ?></th>
            <th><?= $e($usuario['telefono']) ?></th>
            <th><?= $e($usuario['email']) ?></th>
        </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</table>