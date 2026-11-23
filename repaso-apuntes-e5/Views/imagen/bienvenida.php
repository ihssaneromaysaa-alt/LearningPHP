<section class="tarjeta">
    <h1>
        Bienvenido 
    </h1>

    <div class="alerta alerta-ok">
        Has iniciado sesión correctamente.
        <?php
             $directorio = "uploads/";
            var_dump(is_dir($directorio));
            
            if (is_dir($directorio)) {
                // recorremos el directorio con DirectoryIterator
                echo "<h3>Contenido del directorio:</h3>";
                try {
                    $iterador = new DirectoryIterator($directorio);
                    foreach ($iterador as $elemento) {
                        if (!$elemento->isDot() && $elemento->isFile()) {
                            $nombre = $elemento->getFilename();
                            echo '<img src="' . htmlspecialchars($directorio . $nombre) . '" alt="' . htmlspecialchars($nombre) . '" width="150"><br><br>';
                        }
                    }
                } catch (UnexpectedValueException $error) {
                    echo "Error al leer el directorio: "
                        . htmlspecialchars($error->getMessage());
                }
            }
        ?>
    </div>
    <a class="boton" href="index.php?controller=imagen&action=formulario">
        Volver al formulario
    </a>
</section>