
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <form action="nuevoAmigo.php" method="post">
        <p>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="contacto[nombre]" required></input>
        </p>

        <p>
            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" name="contacto[apellido]" required></input>
        </p>

        <p>
            <input type="checkbox" name="contacto[marcar]" id="marcar" value="1" required></input>
            <label for="marcar">Aceptar los términos y condiciones</label>
        </p>

        <input type="submit" value="Enviar datos">
    </form>
</body>
</html>
