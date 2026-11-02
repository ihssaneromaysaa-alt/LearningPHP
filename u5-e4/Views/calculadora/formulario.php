<section class="tarjeta">
    <h1>Calculadora</h1>

    <?php if (!empty($error)): ?>
        <div class="alerta alerta-error"><?= $e($error) ?></div>
    <?php endif; ?>

    <form method="post" action="index.php?controller=calculadora&action=calcular">
        <div class="campo">
            <label for="numero1">Primer número</label>
            <input type="number" step="any" id="numero1" name="numero1" required value="<?= $e($numero1 ?? '') ?>">
        </div>

        <div class="campo">
            <label for="numero2">Segundo número</label>
            <input type="number" step="any" id="numero2" name="numero2" required value="<?= $e($numero2 ?? '') ?>">
        </div>

        <!-- los cuatro botones comparten name pero tienen distinto value -->
        <div class="boton-grupo">
            <button class="boton" type="submit" name="operacion" value="sumar">+ sumar</button>
            <button class="boton" type="submit" name="operacion" value="restar">− restar</button>
            <button class="boton" type="submit" name="operacion" value="multiplicar">× multiplicar</button>
            <button class="boton" type="submit" name="operacion" value="dividir">÷ dividir</button>
        </div>
    </form>

    <?php if (isset($resultado)): ?>
        <p class="resultado" style="margin-top:1.5rem">
            <?= $e($numero1) ?> <?= $e($simbolo) ?> <?= $e($numero2) ?> = <?= $e($resultado) ?>
        </p>
    <?php endif; ?>
</section>