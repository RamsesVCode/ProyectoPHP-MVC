<!--BARRA LATERAL-->  
<aside id="lateral">
    <div id="login" class="block_aside">
        <h3>Mi carrito</h3>
        <?php $stats = Utils::statsCarrito();?>
        <ul>
            <li><a href="<?=base_url?>carrito/index">Productos: (<?=$stats['count'];?>)</a></li>
            <li><a href="<?=base_url?>carrito/index">Total: <?=$stats['total'];?> $</a></li>
            <li><a href="<?=base_url?>carrito/index">Ver carrito</a></li>
        </ul>
    <?php if(!isset($_SESSION['identity'])):?>
        <h3>Ingresar</h3>
        <?php if(isset($_SESSION['login']) && $_SESSION['login']=='Failed'):?>
            <strong class="alerta_red">Logeo Fallido</strong>
        <?php endif;?>
        <?php Utils::deleteSession('login');?>

        <form action="<?=base_url?>usuario/login" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email">
            <label for="password">Contraseña</label>
            <input type="password" name="password">
            <input type="submit" value="Enviar"/>
        </form>
    <?php endif;?>
    <?php if(isset($_SESSION['identity'])):?>
        <h3><?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?></h3>
        <ul>
            <?php if(isset($_SESSION['admin'])):?>
            <li><a href="<?=base_url?>categoria/gestion">Gestionar categorias</a></li>
            <li><a href="<?=base_url?>producto/gestion">Gestionar productos</a></li>
            <li><a href="<?=base_url?>pedido/gestion">Gestionar pedidos</a></li>
            <?php endif;?>
            <li><a href="<?=base_url?>pedido/mis_pedidos">Mis pedidos</a></li>
            <li><a href="<?=base_url?>usuario/exit">Cerrar sesión</a></li>
            <?php else:?>
            <li><a href="<?=base_url?>usuario/registro">Registrarse</a></li>
        </ul>
    <?php endif;?>
    </div>
</aside>

<!--CONTENIDO CENTRAL-->
<div id="central">