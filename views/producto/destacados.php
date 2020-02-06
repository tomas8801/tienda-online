<h1>Algunos de nuestros productos</h1>
<?php foreach ($productos as $pro): ?>

    <div id="product">
        <a href="<?= url_base?>producto/ver&id=<?=$pro->id ?>">
            <?php if ($pro->image != null): ?>
                <img src="<?= url_base ?>uploads/images/<?= $pro->image ?>" alt="">
            <?php else: ?>
                <img src="<?= url_base ?>assets/img/logo.png" alt="">
            <?php endif; ?>
        </a>

        <div class="info">
            <h2><a style="background: none;color: #222"href="<?= url_base?>producto/ver&id=<?=$pro->id ?>"><?= $pro->nombre ?></a></h2>
            <p>$<?= $pro->precio ?> ARS</p>
            <a href="<?= url_base?>carrito/add&id=<?=$pro->id?>">Comprar</a>
        </div>
    </div>
<?php endforeach; ?>
