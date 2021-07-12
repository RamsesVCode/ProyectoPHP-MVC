<?php
require_once 'models/producto.php';
class CarritoController{
    public function index(){
        require_once 'views/carrito/index.php';
    }
    public function add(){
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $producto_id = $_GET['id'];
        }else{
            header('Location:'.base_url.'carrito/index');
        }

        //SI YA EXISTE EL CARRITO
        if(isset($_SESSION['carrito'])){
            $counter = 0;
            foreach($_SESSION['carrito'] as $indice => $valor){
                if($valor['id_producto'] == $producto_id){
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $counter++;
                }
            }
        }

        //SI NO EXISTE EL CARRITO
        if(!isset($_SESSION['carrito']) || $counter==0){
            //CREAMOS EL PRODUCTO
            $producto = new Producto();
            $producto->setId($producto_id);
            $producto = $producto->getOneById();
            
            //AÑADIMOS AL CARRITO
            $_SESSION['carrito'][] = array(
            'id_producto'=>$producto_id,
            'unidades'=>1,
            'precio'=>$producto->precio,
            'producto'=>$producto
        );
        }
        header('Location:'.base_url.'carrito/index');
    }
    public function deleteAll(){
        if(isset($_SESSION['carrito'])){
            unset($_SESSION['carrito']);
        }
        header('Location:'.base_url.'carrito/index');
    }
    public function remove(){
        if(isset($_GET['index']) && is_numeric($_GET['index'])){
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }
        header('Location:'.base_url.'carrito/index');
    }
    public function up(){
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $producto_id = $_GET['id'];
        }else{
            header('Location:'.base_url.'carrito/index');
        }
        if(isset($_SESSION['carrito'])){
            foreach($_SESSION['carrito'] as $indice => $valor){
                if($valor['id_producto'] == $producto_id){
                    $_SESSION['carrito'][$indice]['unidades']++;
                }
            }
        }
        header('Location:'.base_url.'carrito/index');
    }
    public function down(){
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $producto_id = $_GET['id'];
        }else{
            header('Location:'.base_url.'carrito/index');
        }
        if(isset($_SESSION['carrito'])){
            foreach($_SESSION['carrito'] as $indice => $valor){
                if($valor['id_producto'] == $producto_id){
                    if($_SESSION['carrito'][$indice]['unidades']>1){
                        $_SESSION['carrito'][$indice]['unidades']--;
                    }else{
                        unset($_SESSION['carrito'][$indice]);
                    }
                }
            }
        }
        header('Location:'.base_url.'carrito/index');
    }
}
?>