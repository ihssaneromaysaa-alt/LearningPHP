<h1>usuarios registrados</h1>
<table class="datos">
    <thead>
        <tr>
            <th>nombre</th>
            <th>correo</th>
            <th>edad</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= $e($usuario["nombre"]) ?></td>
                <td><?= $e($usuario["correo"]) ?></td>
                <td><?= $e($usuario["edad"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="index.php?accion=libros" class="boton">volver al listado</a>
