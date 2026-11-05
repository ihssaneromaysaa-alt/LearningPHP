
<?php

// definimos las rutas de los directorios y archivos
$directorio = __DIR__ . '/mi_directorio';
$archivoOriginal = __DIR__ . '/assets/prueba.txt';
$archivoCopia = $directorio . '/prueba.txt';

// comprobamos que existe el archivo original
if (!is_file($archivoOriginal))
    die("Error: El archivo original no existe.");


// comprobamos si existe el directorio
if (!is_dir($directorio)) {
    echo "El directorio no existe. Vamos a crearlo.<br>";
    // creamos el directorio
    if (mkdir($directorio, 0755)) {
        echo "Directorio creado correctamente.<br>";
        // copiamos el archivo de texto dentro
        if (copy($archivoOriginal, $archivoCopia)) {
            echo "Archivo copiado correctamente.<br>";
            // recorremos el directorio con DirectoryIterator
            echo "<h3>Contenido del directorio:</h3>";
            try {
                $iterador = new DirectoryIterator($directorio);
                foreach ($iterador as $elemento)
                    // evitamos mostrar los elementos . y ..
                    if (!$elemento->isDot())
                        echo htmlspecialchars($elemento->getFilename()) . "<br>";
            } catch (UnexpectedValueException $error) {
                echo "Error al leer el directorio: "
                    . htmlspecialchars($error->getMessage());
            }

        } else
            echo "Error: No se pudo copiar el archivo.";
    } else 
        echo "Error: No se pudo crear el directorio.";
} else {
    // si el directorio ya existe
    echo "El directorio ya existe. No es necesario crearlo.";
}
