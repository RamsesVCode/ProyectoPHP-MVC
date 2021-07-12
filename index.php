<?php
session_start();
require_once 'autoload.php';
require_once 'config/database.php';
require_once 'config/parameters.php';
require_once 'helpers/Utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

//FUNCION PARA POSIBLES ERRORES
function showError(){
    $error = new ErrorController();
    $error->index();
}
if(isset($_GET['controller'])){
    $nombre_controlador = $_GET['controller'].'Controller';
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    $nombre_controlador = controller_default;
}else{
    showError();
    exit();
}

if(class_exists($nombre_controlador)){
    $controller = new $nombre_controlador();
    if(isset($_GET['action']) && method_exists($controller,$_GET['action'])){
        $action = $_GET['action'];
        $controller->$action();
    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        $action_default = action_default;
        $controller->$action_default();
    }else{
        showError();
    }
}



require_once 'views/layout/footer.php';
?>