<h1>Registrarse</h1>
<div id="register" class="block_aside">
    <?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?> 
            <strong class="alert_complete">Te registraste correctamente!</strong>
    <?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'):?>
            <strong class="alert_failed">Hubo un error al registrarte!</strong>
    <?php endif;?>
    <?php App\helpers\Utils::deleteSession('register'); ?>
    <form action="<?=url_base?>usuario/save" method="post">
       
        <?php echo isset($_SESSION['errores']) ? App\helpers\Utils::mostrarError($_SESSION['errores'], 'nombre') : ''; ?> 
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name">
        <?php echo isset($_SESSION['errores']) ? App\helpers\Utils::mostrarError($_SESSION['errores'], 'apellido') : ''; ?>
        <label for="name">Apellido</label>
        <input type="text" name="surname" id="surname"required>
        <?php echo isset($_SESSION['errores']) ? App\helpers\Utils::mostrarError($_SESSION['errores'], 'email') : ''; ?>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <?php echo isset($_SESSION['errores']) ? App\helpers\Utils::mostrarError($_SESSION['errores'], 'password') : ''; ?>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required>
        
        <input type="submit" name="submit" value="Registrarse">
        <?php App\helpers\Utils::deleteSession('errores'); ?>
    </form>                               
</div>