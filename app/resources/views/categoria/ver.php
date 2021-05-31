<?php if (isset($categoria)) : ?>
    <h1><?= $categoria->nombre ?></h1>
    <?php if (count($productos) == 0) : ?>
        <p>No hay productos para esta categoria</p>
    <?php else: ?>
        <?php foreach ($productos as $pro): ?>

            <div id="product">
                <?php if ($pro->image != null): ?>
                    <img src="<?= url_base ?>uploads/images/<?= $pro->image ?>" alt="">
                <?php else: ?>
                    <img src="<?= url_base ?>assets/img/logo.png" alt="">
                <?php endif; ?>
                <div class="info">
                    <h2><?= $pro->nombre ?></h2>
                    <p>$<?= $pro->precio ?> ARS</p>
                    <a href="<?= url_base?>carrito/add&id=<?=$pro->id?>">Comprar</a>
                </div>
            </div>
        <?php endforeach; ?>    

    <?php endif; ?>
<?php else: ?>
    <h1>La categoria no existe</h1>
<?php endif; ?>









