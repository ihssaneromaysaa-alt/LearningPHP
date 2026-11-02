<section class="tarjeta">
    <h1>Alta alumno</h1>

    <form method="post" action="index.php?controller=alumno&action=recibir">
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre">
        </div>

        <div class="campo">
            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos">
        </div>

        <div class="campo">
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento">
        </div>

        <div class="campo">
            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email">
        </div>

        <div class="campo">
            <label>¿Qué lenguajes de programación conoces?</label>
            <div class="opciones">
                <label><input type="checkbox" name="lenguajes[]" value="C++"> C++</label>
                <label><input type="checkbox" name="lenguajes[]" value="JavaScript"> JavaScript</label>
                <label><input type="checkbox" name="lenguajes[]" value="Php"> Php</label>
                <label><input type="checkbox" name="lenguajes[]" value="Python"> Python</label>
            </div>
        </div>

        <div class="campo">
            <label>¿Sabes crear páginas web estáticas?</label>
            <div class="opciones">
                <label><input type="radio" name="sabe_web" value="si" checked> Sí</label>
                <label><input type="radio" name="sabe_web" value="no"> No</label>
            </div>
        </div>

        <div class="campo">
            <label for="comentarios">Comentarios</label>
            <textarea id="comentarios" name="comentarios"></textarea>
        </div>

        <div class="campo">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password">
        </div>

        <div class="campo">
            <label for="password2">Repita la contraseña</label>
            <input type="password" id="password2" name="password2">
        </div>

        <h2>Inputs extra para experimentar</h2>

        <div class="campo">
            <label for="color">Color favorito</label>
            <input type="color" id="color" name="color" value="#2563eb">
        </div>

        <div class="campo">
            <label for="numero">Número de la suerte</label>
            <input type="number" id="numero" name="numero" min="0" max="100">
        </div>

        <button class="boton" type="submit">Enviar</button>
    </form>
</section>