<h1>Nuevo contacto</h1>

<form action="index.php?controller=contacto&amp;action=procesar" method="post">
        <p>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="contacto[nombre]" required></input>
            <?php if (!empty($errores['nombre'])): ?>
                <span class="error"><?= htmlspecialchars($errores['nombre']) ?></span>
            <?php endif; ?>
        </p>

        <p>
            <label for="apellidos">Apellido</label>
            <input type="text" id="apellidos" name="contacto[apellidos]" required></input>
            <?php if (!empty($errores['apellidos'])): ?>
                <span class="error"><?= htmlspecialchars($errores['apellidos']) ?></span>
            <?php endif; ?>
        </p>

        <p>
            <label for="correo">Correo</label>
            <input type="email" id="correo" name="contacto[correo]" required></input>
            <?php if (!empty($errores['correo'])): ?>
                <span class="error"><?= htmlspecialchars($errores['correo']) ?></span>
            <?php endif; ?>
        </p>

        <p>
            
        <label for="metodosPago">Seleccione método de pago</label>
        <select id="metodosPago" name="contacto[metodosPago][]" multiple size="3">
            <option value="VISA" selected>VISA</option>
            <option value="MASTERCARD">MASTERCARD</option>
            <option value="BIZUM">BIZUM</option>
        </select>
        <?php if (!empty($errores['contacto'])): ?>
            <span class="error"><?= htmlspecialchars($errores['contacto']) ?></span>
        <?php endif; ?>
        </p>
        <p>
            <input type="checkbox" name="contacto[marcar]" id="marcar" value="1" required></input>
            <label for="marcar">Aceptar los términos y condiciones</label>
            <?php if (!empty($errores['marcar'])): ?>
                <span class="error"><?= htmlspecialchars($errores['marcar']) ?></span>
            <?php endif; ?>
        </p>
        <input type="submit" value="Enviar datos">
    </form>