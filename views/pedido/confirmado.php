<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete') : ?>
    <h1>Tu pedido se ha confirmado</h1>
    <p>
        Tu pedido ha sido guardado con exito, una vez que realices la transferencia bancaria
        con el coste del pedido, será procesado y enviado.
    </p>
    <?php if (isset($pedido)): ?>
       
        <h3>Datos del pedido</h3>

        Número de pedido: <?= $pedido->id ?><br>
        Total a pagar: <?= $pedido->monto ?><br>
        Productos:

        <?php foreach ($_SESSION['carrito'] as $producto): ?>
            <ul>
                <li><?= $producto['producto']->nombre?> - <?= $producto['precio']?> - x<?= $producto['unidades']?></li>
            </ul>

        <?php endforeach; ?>
    <?php endif; ?>
    <a href="<?=url_base?>pago/pagar">Pagar</a>
<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete') : ?>
    <h1>Tu pedido NO ha podido procesarse</h1>
<?php endif; ?>

