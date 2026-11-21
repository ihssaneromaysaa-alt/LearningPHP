
    <h1>mostrar imagenes y añadirlas</h1>
    <!-- novalidate: la validacion la hace el servidor -->
    <form method="post" action="<?= (url('cargarImagen')) ?>" enctype="multipart/form-data" novalidate>
        <label for="foto">Foto</label>
        <input type="file" id="foto" name="foto" accept="image/*"
                class="<?= isset($errores['foto']) ? 'invalido' : '' ?>" autocomplete="off">
        <?php if (isset($errores['foto'])): ?>
            <div class="error-campo"><?= htmlspecialchars($errores['foto']) ?></div>
        <?php endif; ?>
        <button class="boton" type="submit">Cargar Imagen</button>
    </form>

<h1>
    lista de imagenes
</h1>
<?php
    $directorio = "uploads/";
    
    if (is_dir($directorio)) {
        // recorremos el directorio con DirectoryIterator
        echo "<h3>Contenido del directorio:</h3>";
        try {
            $iterador = new DirectoryIterator($directorio);
            foreach ($iterador as $elemento) {
                if (!$elemento->isDot() && $elemento->isFile()) {
                    $nombre = $elemento->getFilename();
                    $rutaFinal = $directorio . $nombre;
                    ?>
                    <img src="<?= htmlspecialchars($rutaFinal) ?>"
             alt="<?= htmlspecialchars($nombre) ?>" width="150">

        <form method="post" action="<?= url('eliminarImagen') ?>"
              onsubmit="return confirm('¿Eliminar esta imagen?');"
              style="display:inline">
            <input type="hidden" name="archivo" value="<?= htmlspecialchars($nombre) ?>">
            <button type="submit">Eliminar</button>
        </form>
        <?php
                }
            }
        } catch (UnexpectedValueException $error) {
            echo "Error al leer el directorio: "
                . htmlspecialchars($error->getMessage());
        }
    }
?>
<br>
<br>
<form action="<?= (url('eliminarGaleria')) ?>" method="post"
    onsubmit="return confirm('¿Seguro que quieres vaciar la agenda?');">
    <p>parar vaciar la agenda</p>
    <button type="submit">vaciar galeria</button>
</form>