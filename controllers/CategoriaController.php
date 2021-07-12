<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';
class CategoriaController{
    public function index(){
        echo 'Controlador Categoria, metodo index';
    }
    public function gestion(){
        Utils::logued();
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        require_once 'views/categoria/gestion.php';
    }
    public function crear(){
        require_once 'views/categoria/crear.php';
    }
    public function save(){
        Utils::logued();
        Utils::isAdmin();
        if(isset($_POST) && !empty($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            
            //ERRORES
            $errores = array();

            //VALIDAMOS EL NOMBRE
            if(!$nombre || empty($nombre)){
                $errores['nombre'] = 'Nombre no valido';
            }

            //VERIFICAMOS QUE NO HAYAN ERRORES
            if(empty($errores)){
                $categoria = new Categoria();
                $categoria->setNombre($nombre);
                $save = $categoria->save();

                if($save){
                    $_SESSION['categoria'] = 'Completed';    
                }else{
                    $_SESSION['categoria'] = 'Failed';
                }
            }else{
                $_SESSION['categoria'] = 'Failed';
            }
        }else{
            $_SESSION['categoria'] = 'Failed';
        }
        header('Location:'.base_url.'categoria/gestion');
    }
    public function ver(){
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $id = $_GET['id'];
            //OBJETO CATEGORIA
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOneById();


            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllByCategoryId();
            require_once 'views/categoria/ver.php';
        }else{
            header('Location:'.base_url);
        }
    }
}
?>