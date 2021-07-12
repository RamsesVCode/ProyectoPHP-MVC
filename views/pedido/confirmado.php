<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] = 'Completed'):?>
    <h1>Tu pedido se ha confirmado</h1>
    <p>Tu pedido ha sido guardado con exito una vez que realices la transferencia bancaria a la 784512546312ADDS con el coste del pedido será procesado y enviado.</p>
    <h3>Datos del pedido</h3>
    Número de pedido: <?=$ped->id?><br>
    Coste total a pagar: <?=$ped->coste?><br>
    Productos:<br>
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
<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] = 'Completed'):?>
    <h1>No se pudo confirmar</h1>
<?php endif;?>