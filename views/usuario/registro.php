<h1>Registrarse</h1>
<?php if(isset($_SESSION['registro']) && $_SESSION['registro']=='Completed'):?>
    <strong class="alerta_green">Usuario registrado correctamente</strong>
<?php elseif(isset($_SESSION['registro']) && $_SESSION['registro']=='Completed'):?>
    <strong class="alerta_red">No se pudo registrar el usuario</strong>
<?php endif;?>
<?php Utils::deleteSession('registro');?>

<form action="<?=base_url?>usuario/save" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre">

    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos">

    <label for="email">Email</label>
    <input type="email" name="email">

    <label for="password">Contraseña</label>
    <input type="password" name="password">

    <input type="submit" value="Registrarse">
</form>