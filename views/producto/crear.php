<?php if(isset($edit) && $edit = true):?>
    <h1>Editar producto "<?=$producto->nombre?>"</h1>
    <?php $url = base_url.'producto/update&id='.$producto->id;?>
    <?php if(isset($_SESSION['producto']) && $_SESSION['producto']=='Completed'):?>
        <strong class="alerta_green">Producto actualizado correctamente</strong>
    <?php elseif(isset($_SESSION['producto']) && $_SESSION['producto']!='Completed'):?> 
        <strong class="alerta_red">No se pudo actualizar el producto</strong>
    <?php endif;?>
    <?php Utils::deleteSession('producto');?>
<?php else:?>
    <h1>Crear nuevo producto</h1>
    <?php $url = base_url.'producto/save';?>
<?php endif;?>
<div class="form-container">
    <form action="<?=$url?>" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required value="<?=isset($edit) && $edit==true ? $producto->nombre : false;?>">
    
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" required><?=isset($edit) && $edit==true ? $producto->descripcion : false;?></textarea>
    
        <label for="precio">Precio</label>
        <input type="text" name="precio" required value="<?=isset($edit) && $edit==true ? $producto->precio : false;?>">
    
        <label for="stock">Stock</label>
        <input type="number" name="stock" min=1 required value="<?=isset($edit) && $edit==true ? $producto->stock : false;?>">
    
        <label for="categoria">Categoria</label>
        <?php $categorias = Utils::getAllCategory();?>
        <?php if($categorias && $categorias->num_rows>=1):?>
            <select name="categoria" required>
                <?php while($categoria = $categorias->fetch_object()):?>
                    <option value="<?=$categoria->id?>" <?=isset($edit) && $edit==true && $categoria->id==$producto->categoria_id ? 'selected' : '';?>><?=$categoria->nombre?></option>
                <?php endwhile;?>
            </select>
        <?php endif;?>
        
        <label for="imagen">Imagen</label>
        <?php if(isset($edit) && $edit=true):?>
            <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>">
        <?php endif;?>
        <input type="file" name="imagen" required>
    
        <input type="submit" value="Guardar">
    </form>
</div>