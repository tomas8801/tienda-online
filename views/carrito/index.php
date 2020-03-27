<h1>Carrito de la compra</h1>

<?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) :?>
<table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Eliminar</th>
    </tr>
    <?php if(isset($_SESSION['carrito'])):?>
    <?php foreach ($carrito as $indice => $elemento): 
        $producto = $elemento['producto'];
        ?>
        <tr>
            <td><?php if ($producto->image != null): ?>
                    <img src="<?= url_base ?>uploads/images/<?= $producto->image ?>" alt="" class="img_carrito">
                <?php else: ?>
                    <img src="<?= url_base ?>assets/img/logo.png" alt="" class="img_carrito">
                <?php endif; ?>
            </td>
            <td><a href="<?= url_base ?>producto/ver&id=<?=$producto->id?>"><?= $producto->nombre?></a></td>
            <td><?= $producto->precio?></td>
            <td><a href="<?= url_base?>carrito/up&index=<?=$indice?>">+ </a><?= $elemento['unidades']; ?><a href="<?= url_base?>carrito/down&index=<?=$indice?>"> -</a></td>
            <td><a href="<?= url_base?>carrito/remove&index=<?=$indice ?>" class="button-pedido">Quitar producto</a></td>
        </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</table>

<div class="total-carrito">
    <?php $stats = Utils::statsCarrito();?>
    <h3>Precio total: <?= $stats['total'] ?> $ </h3>
    <a href="<?= url_base?>carrito/delete_all" class="button-delete">Vaciar carrito</a>
    <a href="<?= url_base?>pedido/hacer" class="button-pedido">Hacer pedido</a>
</div>
<?php else: ?>
    <p>El carrito esta vacio, añade algun producto</p>
<?php endif; ?>

