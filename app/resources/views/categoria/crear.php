<h2>Crear categoria</h2>
<form action="<?= url_base?>categoria/save" method="POST">
    <label for="name"></label>
    <input type="text" name="name">
    
    <input type="submit" name="create" value="Crear categoria">
</form>