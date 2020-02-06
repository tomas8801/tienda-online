<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Tienda</title>
        
        <link rel="stylesheet" href="<?= url_base ?>assets/css/styles.css">
    </head>
    <body>
        <div id="container">
            <!--  CABECERA -->
            <header id="header">
                <div id="logo">
                    <img src="<?= url_base ?>assets/img/logo.png" alt="Equilibre logo">
                    <a href="<?= url_base ?>">
                        Equilibre Handmade
                    </a>

                </div>   
            </header>
            <!--  MENU -->
            <?php $categorias = Utils::mostrarCategorias();?>      
            <nav id="menu">
                <ul>
                    <li><a href="<?= url_base?>">Inicio</a></li>
                    <?php foreach($categorias as $cat): ?>
                    <li><a href="<?= url_base?>categoria/ver&id=<?=$cat->id?>"><?= $cat->nombre ?></a></li>
                    <?php endforeach; ?>
                </ul>

            </nav>

            <div id="content">