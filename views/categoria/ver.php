<h1><?=$categoria->nombre?></h1>
<?php if(isset($productos) && $productos->num_rows>=1):?>
<?php while($producto = $productos->fetch_object()):?>
<div class="product">
    <a href="<?=base_url?>producto/ver&id=<?=$producto->id?>">
        <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>">
        <h2><?=$producto->nombre?></h2>
    </a>
    <p><?=$producto->precio?></p>
    <a href="<?=base_url?>carrito/add&id=<?=$producto->id?>" class="button">Comprar</a>
</div>
<?php endwhile;?>
<?php else:?>
    <p>No hay productos disponibles</p>
<?php endif;?>