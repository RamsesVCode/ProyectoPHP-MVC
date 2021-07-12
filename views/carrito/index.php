<h1>Carrito de compra</h1>
<?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito'])>=1):?>
<table class="table">
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Eliminar</th>
    </tr>
    <?php foreach($_SESSION['carrito'] as $indice => $valor):?>
        <tr>
            <td><img src="<?=base_url?>uploads/images/<?=$valor['producto']->imagen?>"></td>
            <td><a href="<?=base_url;?>producto/ver&id=<?=$valor['id_producto']?>"><?=$valor['producto']->nombre?></a></td>
            <td><?=$valor['precio']?></td>
            <td>
                <?=$valor['unidades']?>
                <div class="updown">
                    <a href="<?=base_url?>carrito/up&id=<?=$valor['id_producto']?>" class="button">+</a>
                    <a href="<?=base_url?>carrito/down&id=<?=$valor['id_producto']?>" class="button">-</a>
                </div>
            </td>
            <td><a href="<?=base_url?>carrito/remove&index=<?=$indice?>" class="button delete">Quitar producto</a></td>
        </tr>
    <?php endforeach?>
</table>
<div class="carrito-detail">
    <a href="<?=base_url?>carrito/deleteAll" class="button delete">Vaciar carrito</a>
    <div class="options">
        <?php $stats = Utils::statsCarrito();?>
        <p>Precio total: <?=$stats['total'];?> $</p>
        <a href="<?=base_url?>pedido/hacer" class="button">Hacer pedido</a>
    </div>
</div>
<?php else:?>
    <p>No hay productos en el carrito, compre algun producto</p>
<?php endif;?>