            <button class="panel-btn hamburger hamburger--collapse" type="button">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
            
            <aside class="panel">
                <nav class="menu">

            
                    <?php if(isset($_SESSION['identity'])):?>
                        <h3 class="identity-user"><?= $_SESSION['identity']->nombre  ?> <?= $_SESSION['identity']->apellido  ?></h3>
                    <?php else:?>
                        <a href="<?=url_base?>usuario/registro">Registrate aca</a>
                    <?php endif;?>
                    
                    <?php if(isset($_SESSION['admin'])):?>
                        <div class="panel-admin">
                            <a href="<?=url_base?>categoria/index">Gestionar categorias</a>
                            <a href="<?=url_base?>producto/gestion">Gestionar productos</a>
                            <a href="<?=url_base?>pedido/gestion">Gestionar pedidos</a>
                     <?php endif;?>
                            <?php if(isset($_SESSION['identity'])):?>
                            <a href="<?=url_base?>pedido/mis_pedidos">Mis pedidos</a>
                            <a href="<?=url_base?>usuario/logout" class="logout-btn">Cerrar Sesion</a>
                        </div>
                        <?php endif;?>
                    
            

                    <div class="categorias-panel">
                        <?php foreach($categorias as $cat): ?>
                        <a href="<?= url_base?>categoria/ver&id=<?=$cat->id?>"><?= $cat->nombre ?></a>
                        <?php endforeach; ?>
                    </div>
                </nav>
            </aside>
