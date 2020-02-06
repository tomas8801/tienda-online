<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Tienda</title>
        
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>
        <div id="container">
            <!--  CABECERA -->
            <header id="header">
                <div id="logo">
                    <img src="assets/img/logo.png" alt="Equilibre logo">
                    <a href="index.php">
                        Equilibre Handmade
                    </a>

                </div>   
            </header>
            <!--  MENU -->
            <nav id="menu">
                <ul>
                    <li><a href="">Inicio</a></li>
                    <li><a href="">Categoria 1</a></li>
                    <li><a href="">Categoria 2</a></li>
                    <li><a href="">Categoria 3</a></li>
                    <li><a href="">Nosotros</a></li>
                    <li><a href="">Contacto</a></li>
                </ul>

            </nav>

            <div id="content">
                <!--  BARRA LATERAL -->
                <aside id="lateral">
                    <div id="login" class="block_aside">
                        <h3>Entrar a la web</h3>
                        <form action="login.php" method="post">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" id="password">
                            <input type="submit" value="Ingresar">
                        </form>
                        <ul>
                            <li><a href="#">Mis pedidos</a></li>
                            <li><a href="#">Gestionar pedidos</a></li>
                            <li><a href="#">Gestionar categorias</a></li>

                        </ul>
                        
                        
                        

                    </div>
                    <div id="login" class="block_aside">
                        <form action="register.php" method="post">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name">
                            <label for="name">Apellido</label>
                            <input type="text" name="surname" id="surname">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" id="password">
                            <input type="submit" value="Ingresar">
                        </form>                               
                    </div>

                </aside>

                <!--  CONTENIDO CENTRAL -->
                <div id="central">
                    <h1>Productos destacados</h1>
                    <div id="product">
                        <img src="assets/img/pulsera2.jpg" alt="">
                        <h2>Pulsera Piedra Titanium</h2>
                        <p>$300 ARS</p>
                        <a href="">Comprar</a>
                    </div>

                    <div id="product">
                        <img src="assets/img/pulsera3.jpg" alt="">
                        <h2>Pulsera Piedra Aqua</h2>
                        <p>$300 ARS</p>
                        <a href="">Comprar</a>
                    </div>

                    <div id="product">
                        <img src="assets/img/collar2.jpg" alt="">
                        <h2>Collar Piedra Preciosa</h2>
                        <p>$300 ARS</p>
                        <a href="">Comprar</a>
                    </div>
                </div>
            </div> 

            <!--  FOOTER -->
            <footer id="footer">
                <p>Desarrollado por Tomas Marsili &copy; <?= date('Y')?> </p>
            </footer>
        </div>
    </body>
</html>
