<?php if (isset($gestion)):?>
    <h1>Gestionar pedidos</h1>
<?php else: ?>
    <h1>Mis pedidos</h1>
<?php endif; ?>
<table>
    <tr>
        <th>N° Pedido</th>
        <th>Coste</th>
        <th>Fecha</th>
        <th>Estado</th>
    </tr>
    <?php foreach ($pedidos as $ped): ?>
        <tr>
            <td>
                <a href="<?= url_base ?>pedido/detalle&id=<?= $ped->id ?>"><?= $ped->id ?></a>
            </td>
            <td>
                <?=App\helpers\Utils::statsCarrito()['total']; ?> $
            </td>
            <td>
                <?= $ped->fecha ?>
            </td>
            <td>
                <?= App\helpers\Utils::showStatus($ped->estado) ?>
            </td>

        </tr>
    <?php endforeach; ?>

</table>