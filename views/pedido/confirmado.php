<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete') : ?>
    <h1>Tu pedido se ha confirmado</h1>
    <p>
        Tu pedido ha sido guardado con exito, una vez que realices la transferencia bancaria
        con el coste del pedido, será procesado y enviado.
    </p>
    <?php if (isset($pedido)): ?>
        <h3>Datos del pedido</h3>

        Número de pedido: <?= $pedido->id ?><br>
        Total a pagar: <?= $pedido->coste ?><br>
        Productos:

        <?php foreach ($productos as $pro): ?>
            <ul>
                <li><?= $pro->nombre?> - <?= $pro->precio?> - x<?= $pro->unidades?></li>
            </ul>

        <?php endforeach; ?>
    <?php endif; ?>
<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete') : ?>
    <h1>Tu pedido NO ha podido procesarse</h1>
<?php endif; ?>

