<?php if(isset($admin) && $admin=true):?>
    <h1>Gestionar pedidos</h1>
<?php else:?>
    <h1>Mis pedidos</h1>
<?php endif;?>
<?php if(isset($pedidos) && $pedidos->num_rows>=1):?>
    <table class="table">
        <tr>
            <th>N° Pedidos</th>
            <th>Coste</th>
            <th>Fecha</th>
            <?php if(isset($admin) && $admin=true):?>
                <th>Estado</th>
            <?php endif;?> 
        </tr>
        <?php while($pedido = $pedidos->fetch_object()):?>
            <tr>
                <td><a href="<?=base_url?>pedido/detalle&id=<?=$pedido->id?>"><?=$pedido->id?></a></td>
                <td><?=$pedido->coste?></td>
                <td><?=$pedido->fecha?></td>
                <?php if(isset($admin) && $admin=true):?>
                    <td><?=$pedido->estado?></td>
                <?php endif;?> 
            </tr>
        <?php endwhile;?>
    </table>
<?php else:?>
    <p>No hay pedidos disponibles</p>
<?php endif;?>