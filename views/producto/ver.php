<h1><?=$producto->nombre?></h1>
<div class="producto-container">
    <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>">
    <div class="producto-detail">
        <p><?=$producto->descripcion?></p>
        <p><?=$producto->precio?> $</p>
        <p><?=$producto->stock?> unidades</p>
        <a href="<?=base_url?>carrito/add&id=<?=$producto->id?>" class="button">Comprar</a>
    </div>
</div>