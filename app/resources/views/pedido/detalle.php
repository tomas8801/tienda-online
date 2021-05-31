<h1>Detalles del pedido</h1>

<?php if (isset($pedido)): ?>
    <?php if (isset($_SESSION['admin'])): ?>
        <h2>Cambiar estado del pedido</h2>
        <form action="<?=url_base?>pedido/estado" method="POST">
            <input type="hidden" value="<?=$pedido->id ?>" name="pedido_id">
            <select name="estado" id="">               
                <option value="confirm" <?= $pedido->estado == 'confirm' ? 'selected' : '' ?> >Pendiente</option>
                <option value="preparation" <?= $pedido->estado == 'preparation' ? 'selected' : '' ?> >En preparacion</option>
                <option value="ready" <?= $pedido->estado == 'ready' ? 'selected' : '' ?> >Preparado para enviar</option>
                <option value="sended" <?= $pedido->estado == 'sended' ? 'selected' : '' ?> >Enviado</option>
            </select>
            <input type="submit" value="Cambiar estado">
        </form>
    <?php endif; ?>
    <h3>Datos del usuario</h3>
    Nombre: <?= $pedido->nombre ?><br>
    Apellido: <?= $pedido->apellido ?><br>
    Email: <?= $pedido->email ?><br><br>
    
    
    
    <h3>Direccion de envio</h3>
    Provincia: <?= $pedido->provincia ?><br>
    Localidad: <?= $pedido->localidad ?><br>
    Direccion: <?= $pedido->direccion ?><br><br>

    <h3>Datos del pedido</h3>
    Estado del pedido: <?= App\helpers\Utils::showStatus($pedido->estado) ?><br>
    Número de pedido: <?= $pedido->id ?><br>
    Total a pagar: <?= $pedido->coste ?><br>
    Productos:<br><br>

    <?php foreach ($productos as $pro): ?>
        <table>
            <tr>
                <td><?= $pro->nombre ?></td>
                <td><?= $pro->precio ?> $</td>
                <td>x<?= $pro->unidades ?></td>
            </tr>
        </table>

    <?php endforeach; ?>
<?php endif; ?>