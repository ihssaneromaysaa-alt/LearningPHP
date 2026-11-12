<section class="tarjeta">
    <h1>registro de usuarios</h1>
    <form action="index.php?controller=usuario&action=registrar" method="post" novalidate>
        <div class="campo">
        <label for="nombre">nombre:</label>
        <input type="text" name="nombre" required>
        </div>
        <div class="campo">
            
        <label for="correo">correo:</label>
        <input type="email" name="correo" required>
        
        </div>
        
        <div class="campo">
            <label for="edad">edad:</label>
            <input type="number" name="edad" min="1" required>
        </div>
        <button  class="boton" type="submit">enviar</button>
    </form>
</section>