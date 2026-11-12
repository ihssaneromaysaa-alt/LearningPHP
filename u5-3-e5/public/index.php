<?php
// crear y escribir en un fichero
// "w+": crea el fichero si no existe y permite leer y escribir.
$archivo = fopen("archivo.txt", "w+");

// si se ha abierto correctamente
if ($archivo == false) {
    echo "Error al abrir el fichero";
}


fwrite($archivo, "mi primera línea\r\n");
fwrite($archivo, "mi segunda línea\r\n");
fwrite($archivo, "mi tercera línea\r\n");

fclose($archivo);

// abrimos el archivo para leerlo
$archivo = fopen("archivo.txt", "r");

if ($archivo == false) {
    echo "Error al abrir el fichero";
}

// leer el archivo linea por linea
while (($linea = fgets($archivo)) !== false) {
    echo $linea . "<br>";
}

fclose($archivo);


// abrimos el archivo de nuevo para añadir contenido al final
// si el fichero existe, escribe al final.
// si no existe, lo crea
$archivo = fopen("archivo.txt", "a");

fwrite($archivo, "Esta es una nueva línea\r\n");

fclose($archivo);

// para copiar el archivo
// queremos copiar el archivo (archivo.txt) y el archivo de copia se llamará 
// archivoCopia.txt
if (copy("archivo.txt", "archivoCopia.txt")) {
    echo "copia realizada correctamente";
} else {
    echo "error al copiar el fichero";
}

// renombrar
if (rename("archivoCopia.txt", "nuevoarchivoCopia.txt")) {
    echo "Fichero renombrado correctamente";
} else {
    echo "Error al renombrar el fichero";
}

// eliminar
if (unlink("nuevoarchivoCopia.txt")) {
    echo "Fichero eliminado correctamente";
} else {
    echo "Error al eliminar el fichero";
}