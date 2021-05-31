


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Tienda</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hamburgers/1.1.3/hamburgers.min.css">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
             <?php $categorias = App\helpers\Utils::mostrarCategorias();?>      
            <nav id="menu">
                <ul>
                    <li><a href="<?= url_base?>">Inicio</a></li>
                    <?php foreach($categorias as $cat): ?>
                    <li><a href="<?= url_base?>categoria/ver&id=<?=$cat->id?>"><?= $cat->nombre ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            
            <?php include '../app/resources/views/includes/panel_mobile.php';?>
            <!-- <button class="panel-btn hamburger hamburger--collapse" type="button">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
            <aside class="panel">
                <nav class="menu">
                    <?php foreach($categorias as $cat): ?>
                    <a href="<?= url_base?>categoria/ver&id=<?=$cat->id?>"><?= $cat->nombre ?></a>
                    <?php endforeach; ?>
                </nav>
            </aside> -->

            <!-- CAROUSEL -->
            <?php include '../app/resources/views/includes/carrousel.php' ?>
            <div id="content">
              