<?php if (isset($_SESSION['identity'])): ?>
    <h1>Hacer pedido</h1>
    <a href="<?= url_base ?>carrito/index">Ver los productos y precios del pedido</a>
   
    <h3>Direccion para el envio:</h3>
    <form action="<?= url_base?>pedido/add" method="POST">
        <label for="">Provincia</label>
        <input type="text" name="provincia" required>
        
        <label for="">Localidad</label>
        <input type="text" name="localidad" required>
        
        <label for="">Direccion</label>
        <input type="text" name="direccion" required>

        <label for="">Código Postal</label>
        <input type="text" name="cod_postal" required>

        <label for="">Teléfono</label>
        <input type="text" name="telefono" required>
        
        <input type="submit" value="Siguiente">
    </form>
<?php else: ?>
    <h1>Necesitas estar indentificado</h1>
    <p>Necesitas estar logueado en la web para poder realizar tu pedido.</p>
<?php endif; ?>