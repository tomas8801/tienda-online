<h2>Gestionar categorias</h2>
<a href="<?= url_base?>categoria/crear" class="button button-small">Crear</a>

<?php if(isset($_SESSION['creacion']) && $_SESSION['creacion'] == 'complete'): ?> 
        <strong class="alert_complete">Categoria creada!</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'):?>
        <strong class="alert_failed">Error en la creacion</strong>
<?php endif;?>
<?php Utils::deleteSession('creacion'); ?>
<table>
    <thead>
        <tr>
            <td>ID</td>
            <td>Nombre</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($categorias as $cat):?>
        <tr>
            <td><?= $cat->id?></td>
            <td><?= $cat->nombre?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    
</table>


