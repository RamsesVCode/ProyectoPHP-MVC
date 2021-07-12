<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Tienda Master</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css"/>
    </head>
    <body>
        <div id="container">
            <!--CABECERA-->
            <header id="header">
                <div id="logo">
                    <img src="<?=base_url?>assets/img/camiseta.png" alt="camiseta Logo"/>
                    <a href="<?=base_url?>">
                        <h1>Tienda de camisetas</h1>
                    </a>
                </div>
            </header>

            <!--MENU-->
            <nav id="menu">
                <?php $categorias = Utils::getAllCategory();?>
                <ul>
                    <li><a href="<?=base_url?>">Inicio</a></li>
                    <?php if(isset($categorias) && $categorias->num_rows>=1):?>
                        <?php while($categoria = $categorias->fetch_object()):?>
                            <li><a href="<?=base_url?>categoria/ver&id=<?=$categoria->id?>"><?=$categoria->nombre?></a></li>
                        <?php endwhile;?>
                    <?php endif;?>
                </ul>
            </nav>

            <div id="content">