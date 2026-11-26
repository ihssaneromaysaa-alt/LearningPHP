<h1 class="carrito-titulo">Carrito de la compra</h1>

<div class="carrito-form">
    <h2>Introduce los productos que deseas comprar</h2>

    <form action="<?= e(BASE_URL . 'carrito/anadir') ?>" method="post">
        <label>
            Dime el producto
            <input type="text" name="producto" required placeholder="Ej: raqueta">
        </label>

        <label>
            Cuántas unidades
            <select name="cantidad">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </label>

        <div class="carrito-botones">
            <button type="submit" class="btn-anadir">Añadir a la cesta</button>
            <a href="<?= e(BASE_URL . 'carrito/pedidos') ?>" class="btn-comprar">Comprar</a>
        </div>
    </form>
</div>