<h1>Gestionar categorias</h1>
<a href="<?=base_url?>categoria/crear" class="button category">Crear categoria</a>

<?php if(isset($_SESSION['categoria']) && $_SESSION['categoria']=='Completed'):?>
    <strong class="alerta_green">Categoria creada exitosamente</strong>
<?php elseif(isset($_SESSION['categoria']) && $_SESSION['categoria']!='Completed'):?>
    <strong class="alerta_red">Error al crear la categoria</strong>
<?php endif;?>
<?php Utils::deleteSession('categoria');?>

<?php if(isset($categorias) && $categorias->num_rows>=1):?>
<table class="table">
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
    </tr>
    <?php while($categoria = $categorias->fetch_object()):?>
        <tr>
            <td><?=$categoria->id?></td>
            <td><?=$categoria->nombre?></td>
        </tr>
    <?php endwhile;?>
</table>
<?php else:?>
    <p>No hay categorias</p>
<?php endif;?>