<h1>Crear nueva categoria</h1>
<form action="<?=base_url?>categoria/save" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre">

    <input type="submit" value="guardar">
</form>