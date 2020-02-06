<h2>Gestionar productos</h2>
<a href="<?= url_base ?>producto/crear" class="button button-small">Crear</a>

<!--MENSAJES/ERRORES -->
<?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'Complete'): ?>
    <?php if(isset($editar)):?>
        <strong class="alert_complete">Producto guardado!</strong>
    <?php else: ?>
        <strong class="alert_complete">Producto Editado!</strong>
    <?php endif;?>
<?php elseif (isset($_SESSION['creacion']) && $_SESSION['creacion'] == 'Failed'): ?>
    <?php if(isset($editar)):?>
        <strong class="alert_failed">Error al guardar producto</strong>
    <?php else: ?>
        <strong class="alert_failed">Error al editar producto</strong>
    <?php endif;?>
<?php endif; ?>

<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Complete'): ?> 
    <strong class="alert_complete">Producto eliminado!</strong>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Failed'): ?>
    <strong class="alert_failed">Error al eliminar producto</strong>
<?php endif; ?>
<?php Utils::deleteSession('producto'); ?>
<table>
    <thead>
        <tr>
            <td>ID</td>
            <td>Nombre</td>
            <td>Precio</td>
            <td>Stock</td>
            <td>Accion</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $pro): ?>
            <tr>
                <td><?= $pro->id ?></td>
                <td><?= $pro->nombre ?></td>
                <td><?= $pro->precio ?></td>
                <td><?= $pro->stock ?></td>
                <td>
                    <a href="<?= url_base ?>producto/editar&id=<?= $pro->id ?>">Editar</a>
                    <a href="<?= url_base ?>producto/eliminar&id=<?= $pro->id ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>

