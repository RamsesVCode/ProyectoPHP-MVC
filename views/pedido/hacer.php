<h1>Hacer pedido</h1>
<a href="">Ver los productos y el precio del pedido</a><br><br>
<h3>Ubicación para el envio</h3>
<form action="<?=base_url?>pedido/save" method="POST">
    <label for="provincia">Provincia</label>
    <input type="text" name="provincia">

    <label for="localidad">Localidad</label>
    <input type="text" name="localidad">

    <label for="direccion">Dirección</label>
    <input type="text" name="direccion">

    <input type="submit" value="Confirmar">
</form>