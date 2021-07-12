<h1>Gestion de productos</h1>
<a href="<?=base_url?>producto/crear" class="button ges-pro">Crear producto</a>
    
<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'Completed'):?>
    <strong class="alerta_green">Producto creado correctamente</strong>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'Completed'):?>
    <strong class="alerta_red">No se pudo crear el producto</strong>
<?php endif;?>
<?php Utils::deleteSession('producto');?>

<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'Completed'):?>
    <strong class="alerta_green">Producto borrado correctamente</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'Completed'):?>
    <strong class="alerta_red">No se pudo borrar el producto</strong>
<?php endif;?>
<?php Utils::deleteSession('delete');?>

<?php if(isset($productos) && $productos->num_rows>=1):?>
<table class="table">
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th>STOCK</th>
        <th>ACCIONES</th>
    </tr>
    <?php while($producto = $productos->fetch_object()):?>
        <tr>
            <td><?=$producto->id?></td>
            <td><?=$producto->nombre?></td>
            <td><?=$producto->precio?></td>
            <td><?=$producto->stock?></td>
            <td>
                <a href="<?=base_url?>producto/editar&id=<?=$producto->id?>" class="button">Editar</a>
                <a href="<?=base_url?>producto/delete&id=<?=$producto->id?>" class="button delete">Eliminar</a>
            </td>
        </tr>
    <?php endwhile;?>
</table>
<?php else:?>
    <p>No hay productos</p>
<?php endif;?>