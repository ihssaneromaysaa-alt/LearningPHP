<h1>Acceso</h1>
<?php if (!empty($error)): ?>
    <p style="color:#b00020"><strong><?= e($error) ?></strong></p>
<?php endif; ?>
<?php if (!empty($info)): ?>
    <p style="color:#0a6b0a"><?= e($info) ?></p>
<?php endif; ?>

<form method="post" action="<?= (url('guardar')) ?>">
    <p><label>texto de la nota</label>
        <input type="text" name="notas[texto]" 
        value="<?= htmlspecialchars($notas['texto'] ?? '') ?>" required></input>
        <?php if (!empty($errores['texto'])): ?>
            <span class="error"><?= htmlspecialchars($errores['texto']) ?></span>
        <?php endif; ?>
    
        <label>está hecha la tarea?</label>
        <input type="checkbox" name="notas[hecha]" value="1" <?= isset($notas['hecha'])?($notas['hecha'] ? 'checked' : ''): '' ?> />
        <?php if (isset($errores['hecha'])): ?>
            <span class="error" style="color: red;"><?= e($errores['hecha']) ?></span>
        <?php endif; ?>    
    </p>
    <p><button type="submit">entrar</button></p>
</form>

<?php if(is_dir('data/')): ?>
<h1>
    lista de imagenes
</h1>
<?php
    $directorio = "data/";
    $ruta = 'data/notas.txt';
    if (is_dir($directorio)) {
        echo "<h3>contenido de las notas:</h3>";
        try {
            $lineas = file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach($lineas as $linea){
                $partes = explode('|', $linea);
                if (count($partes) >= 3) {
                    $texto = $partes[0];
                    $hecha = $partes[1];
                    $id    = $partes[2];
                    ?>
                    <p>
                        <form method="post" action="<?= url('hacerTarea') ?>" style="display:inline">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                            <input type="checkbox"
                                <?= $hecha === '1' ? 'checked' : '' ?>
                                onchange="this.form.submit()">
                        </form>
                        <?= htmlspecialchars($texto) ?>
                    </p>
                    <?php
                }
            }
        } catch (Exception $error) {
            $errorDir = $error->getMessage();
        }
    }
?>
<br>
<br>
<form action="<?= (url('eliminarNotas')) ?>" method="post"
    onsubmit="return confirm('¿Seguro que quieres vaciar todas las notas?');">
    <button type="submit">vaciar block de notas</button>
</form>
<?php endif; ?>
