<form action="index.php" method="post">
    <input type="hidden" name="controller" value="articulo">
    <input type="hidden" name="action" value="buscar">

    <div class="campo">
        <label for="id">Identificador del artículo</label>
        <input
            type="text"
            id="id"
            name="id"
            inputmode="numeric"
            value="<?= $e($idBuscado ?? '') ?>"
            placeholder="por ejemplo, 99"
            aria-describedby="ayuda-id"
        >
        <p class="ayuda" id="ayuda-id">Introduce el número identificador del artículo.</p>
    </div>

    <button class="boton" type="submit">Buscar</button>
</form>
