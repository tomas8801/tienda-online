
<aside id="lateral">
    
    <div id="login" class="block_aside">
        <h3>Carrito</h3>
        <ul>
            <?php $stats = App\helpers\Utils::statsCarrito();?>
            <li><a href="<?=url_base?>carrito/index">Productos (<?= $stats['count'] ?>)</a></li>
            <li><a href="<?=url_base?>carrito/index">Total: <?= $stats['total']?> $ </a></li>
            <li><a href="<?=url_base?>carrito/index">Ver el carrito</a></li>
        </ul>

    </div>
    
    <div id="login" class="block_aside admin">
        <?php if(!isset($_SESSION['identity'])):?>
        <h3>Entrar a la web</h3>
        <form action="<?=url_base?>usuario/login" method="post">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password">
            <input type="submit" name="submit" value="Ingresar">
        </form>
        

        <?php else:?>
        <h3><?= $_SESSION['identity']->nombre  ?> <?= $_SESSION['identity']->apellido  ?></h3>
        <?php endif;?>
        <ul>
            <?php if(isset($_SESSION['admin'])):?>
            <li><a href="<?=url_base?>categoria/index">Gestionar categorias</a></li>
            <li><a href="<?=url_base?>producto/gestion">Gestionar productos</a></li>
            <li><a href="<?=url_base?>pedido/gestion">Gestionar pedidos</a></li>
            <?php endif;?>
            <?php if(isset($_SESSION['identity'])):?>
            <li><a href="<?=url_base?>pedido/mis_pedidos">Mis pedidos</a></li>
            <li><a href="<?=url_base?>usuario/logout">Cerrar Sesion</a></li>
            <?php else:?>
            <li><a href="<?=url_base?>usuario/registro">Registrate aca</a></li>
            <?php endif;?>
        </ul>
    </div>


</aside>

<!--  CONTENIDO CENTRAL -->
<div id="central">
