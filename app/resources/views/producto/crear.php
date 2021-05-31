<?php if(isset($edit) && isset($pro) && is_object($pro)) :?>
    <h2>Editar producto <?= $pro->nombre?></h2>
    <?php $url_action = url_base."producto/update&id=".$pro->id?>
<?php else:?>
    <h2>Crear producto</h2>
    <?php $url_action = url_base."producto/save"?>
<?php endif;?>

<div class="form_container">
    <form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">

        <label for="name">Nombre</label>
        <input type="text" name="name" value="<?= isset($pro) && is_object($pro) ? $pro->nombre : ''?>">

        <label for="description">Descripcion</label>
        <textarea name="description" id="" rows="2" ><?= isset($pro) && is_object($pro) ? $pro->descripcion : ''?></textarea>

        <label for="price">Precio</label>
        <input type="text" name="price" value="<?= isset($pro) && is_object($pro) ? $pro->precio : ''?>">

        <label for="stock">Stock</label>
        <input type="number" name="stock" value="<?= isset($pro) && is_object($pro) ? $pro->stock : ''?>">

        <label for="category">Categoria</label>
        <?php $categorias = App\helpers\Utils::mostrarCategorias(); ?>
        <select name="category" id="">
            <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat->id ?>"<?= isset($pro) && is_object($pro) && $cat->id == $pro->categoria_id ? 'selected' : ''?>> <?= $cat->nombre ?> </option>
            <?php endforeach; ?>
        </select>

        <label for="image">Imagen</label>
        <input type="file" name="image">
        
        <input type="submit" value="save" name="save">
    </form>
</div>