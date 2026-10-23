<?php
// Ruta en disco (para comprobar si el archivo existe)
$dirImg = __DIR__ . '/../../public/assets/img/';
// Ruta en la URL (la que usa el navegador)
$urlImg = '/assets/img/';
?>

<h2><?= htmlspecialchars($titulo) ?></h2>

<?php if (!is_dir($dirImg)): ?>
    <p>No tenemos imágenes (carpeta <code>assets/img</code> no encontrada)</p>

<?php elseif (!isset($cartas) || count($cartas) === 0): ?>
    <p>No hay cartas para mostrar</p>

<?php else: ?>
    <p>Cartas mostradas: <?= count($cartas) ?></p>

    <div style="display: flex; flex-wrap: wrap; gap: 30px;">
        <?php foreach ($cartas as $carta): ?>
            <?php
            $nombreImagen = $carta->getImagen();          // ejemplo: bastos_3.jpg
            $rutaCompleta = $dirImg . $nombreImagen;
            ?>

            <div style="text-align: center; border: 1px solid #ccc; padding: 8px; border-radius: 6px;">
                <div><?= htmlspecialchars((string)$carta) ?></div>

                <?php if (is_file($rutaCompleta)): ?>
                    <img src="<?= $urlImg . $nombreImagen ?>"
                         alt="<?= htmlspecialchars((string)$carta) ?>"
                         width="100">
                <?php else: ?>
                    <span style="color: red;">Sin imagen:<br><?= htmlspecialchars($nombreImagen) ?></span>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>