<?php if (isset($pro)) : ?>
    <h1><?= $pro->nombre ?></h1>

    <div id="detail-product">

        <?php if ($pro->image != null): ?>
            <img src="<?= url_base ?>uploads/images/<?= $pro->image ?>" alt="">
        <?php else: ?>
            <img src="<?= url_base ?>assets/img/logo.png" alt="">
        <?php endif; ?>

        <div class="info">
            <p><?= $pro->descripcion ?></p>
            <p>$<?= $pro->precio ?> ARS</p>
            <a href="<?= url_base?>carrito/add&id=<?=$pro->id?>">Comprar</a>
        </div>
    </div>


<?php else: ?>
    <h1>La categoria no existe</h1>
<?php endif; ?>
