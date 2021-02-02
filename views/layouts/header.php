<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Tienda</title>
        <!-- BOOTSTRAP CSS-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- MY CSS -->
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
            
            <?php include 'views/includes/carrousel.php' ?>
            <div id="content">
              