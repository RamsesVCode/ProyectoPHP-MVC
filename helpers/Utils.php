<?php
class Utils{
    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            unset($_SESSION[$name]);
        }
        return true;
    }
    public static function getAllCategory(){
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        return $categorias;
    }
    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header('Location:'.base_url);
        }
    }
    public static function logued(){
        if(!isset($_SESSION['identity'])){
            header('Location:'.base_url);
        }
    }
    public static function statsCarrito(){
        $stats = array(
            'count'=>0,
            'total'=>0
        );
        if(isset($_SESSION['carrito']) && count($_SESSION['carrito'])>=1){
            foreach($_SESSION['carrito'] as $valor){
                $stats['count'] = count($_SESSION['carrito']);
                $stats['total'] += $valor['unidades']*$valor['precio'];
            }
        }
        return $stats;
    }
}
?>