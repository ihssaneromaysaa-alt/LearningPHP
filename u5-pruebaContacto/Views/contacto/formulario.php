<h1>Nuevo contacto</h1>

<form action="index.php?controller=contacto&amp;action=procesar" method="post">
        <p>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="contacto[nombre]" required></input>
        </p>

        <p>
            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" name="contacto[apellido]" required></input>
        </p>

        <p>
            <label for="correo">Correo</label>
            <input type="email" id="correo" name="contacto[correo]" required></input>
        </p>

        <p>
            
        <label for="metodosPago">Seleccione método de pago</label>
        <select id="metodosPago" name="contacto[metodosPago][]" multiple size="3">
            <option value="VISA" selected>VISA</option>
            <option value="MASTERCARD">MASTERCARD</option>
            <option value="BIZUM">BIZUM</option>
        </select></p>
        <p>
            <input type="checkbox" name="contacto[marcar]" id="marcar" value="1" required></input>
            <label for="marcar">Aceptar los términos y condiciones</label>
        </p>
        <input type="submit" value="Enviar datos">
    </form>