<h1>Detalle del pedido</h1>
<?php if(isset($_SESSION['admin'])):?>
    <h3>Cambiar estado del pedido</h3>
    <?php if(isset($_SESSION['update']) && $_SESSION['update']=='Completed'):?>
        <strong class="alerta_green">Estado actualizado exitosamente</strong>
    <?php elseif(isset($_SESSION['update']) && $_SESSION['update']=='Completed'):?>
        <strong class="alerta_red">No se pudo actualizar el estado</strong>
    <?php endif;?>
    <?php Utils::deleteSession('update');?>
    
    <form action="<?=base_url?>pedido/update&id=<?=$ped->id?>" method="POST">
        <select name="estado">
            <option value="Pendiente" <?=$ped->estado == 'Pendiente' ? 'selected' : '';?>>Pendiente</option>
            <option value="En preparacion" <?=$ped->estado == 'En preparacion' ? 'selected' : '';?>>En preparación</option>
            <option value="Preparado para enviar" <?=$ped->estado == 'Preparado para enviar' ? 'selected' : '';?>>Preparado para enviar</option>
            <option value="Enviado" <?=$ped->estado == 'Enviado' ? 'selected' : '';?>>Enviado</option>
        </select>
        <input type="submit" value="Cambiar estado">
    </form><br>
<?php endif;?>
<h3>Ubicación del envio</h3>
Provincia: <?=$ped->provincia?><br>
Localidad: <?=$ped->localidad?><br>
Dirección: <?=$ped->direccion?><br><br>
<h3>Datos del pedido</h3>
Estado: <?=$ped->estado?><br>
Número de pedido: <?=$ped->id?><br>
Coste total a pagar: <?=$ped->coste?> $ <br>
Productos:
<table class="table">
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
        </tr>
        <?php while($producto = $productos->fetch_object()):?>
            <tr>
                <td><img src="<?=base_url?>uploads/images/<?=$producto->imagen?>"></td>
                <td><a href="<?=base_url?>producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a></td>
                <td><?=$producto->precio?> $</td>
                <td><?=$producto->unidades?></td>
            </tr>
        <?php endwhile;?>
    </table>