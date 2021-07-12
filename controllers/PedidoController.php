<?php
require_once 'models/pedido.php';
class PedidoController{
    public function hacer(){
        Utils::logued();
        require_once 'views/pedido/hacer.php';
    }
    public function save(){
        Utils::logued();
        if(isset($_POST) && !empty($_POST)){
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false; 
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

            //ARRAY DE POSIBLES ERRORES
            $errores = array();

            //VALIDAMOS LA PROVINCIA
            if(!$provincia || empty($provincia)){
                $errores['provincia'] = 'Provincia no valida';
            }
            //VALIDAMOS LA LOCALIDAD
            if(!$localidad || empty($localidad)){
                $errores['localidad'] = 'Localidad no valida';
            }
            //VALIDAMOS LA DIRECCION
            if(!$direccion || empty($direccion)){
                $errores['direccion'] = 'Direccion no valida';
            }

            //VERIFICAMOS QUE NO HAY ERRORES
            if(empty($errores)){
                $pedido = new Pedido();
                $id_usuario = $_SESSION['identity']->id;
                $stats = Utils::statsCarrito(); 
                $coste = $stats['total'];

                $pedido->setId_suario($id_usuario);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                //GUARDAMOS EL PEDIDO
                $save = $pedido->save();

                //GUARDAMOS LAS LINEAS_PEDIDO
                $save_linea = $pedido->save_linea();

                //VACIAMOS EL CARRITO
                if(isset($_SESSION['carrito']) && count($_SESSION['carrito'])>=1){
                    unset($_SESSION['carrito']);
                }

                if($save && $save_linea){
                    $_SESSION['pedido'] = 'Completed';    
                }else{
                    $_SESSION['pedido'] = 'Failed';
                }
            }else{
                $_SESSION['pedido'] = 'Failed';
            }
            header('Location:'.base_url.'pedido/confirmado');
        }
    }
    public function confirmado(){
        Utils::logued();
        $id_usuario = $_SESSION['identity']->id;

        //CREAMOS EL OBJETO PEDIDO
        $pedido = new Pedido();
        $pedido->setId_suario($id_usuario);
        $ped = $pedido->getOneByUser();

        //CREAMOS EL OBJETO PARA PRODUCTOS
        $productos = $pedido->getProductoByPedidoId($ped->id);

        require_once 'views/pedido/confirmado.php';
    }
    public function mis_pedidos(){
        Utils::logued();
        $id_usuario = $_SESSION['identity']->id;
        
        $pedido = new Pedido();
        $pedido->setId_suario($id_usuario);
        $pedidos = $pedido->getAllByUser();
        
        require_once 'views/pedido/mis_pedidos.php';
    }
    public function detalle(){
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $pedido_id = $_GET['id'];
            
            //OBJETO DE PEDIDO
            $pedido = new Pedido();
            $pedido->setId($pedido_id);

            $ped = $pedido->getOneById();
            
            //OBJETO PARA PRODUCTOS
            $productos = $pedido->getProductoByPedidoId($pedido_id); 
            require_once 'views/pedido/detalle.php';
        }
    }
    public function update(){
        Utils::logued();
        Utils::isAdmin();
        if(isset($_GET['id']) && is_numeric($_GET['id']) && isset($_POST) && !empty($_POST)){
            $id = $_GET['id'];
            $estado = isset($_POST['estado']) ? $_POST['estado'] : false;

            if($estado){
                $pedido = new Pedido();
                $pedido->setId($id);
                $pedido->setEstado($estado);
                $update = $pedido->update();
                if($update){
                    $_SESSION['update'] = 'Completed';
                }else{
                    $_SESSION['update'] = 'Failed';
                }
            }else{
                $_SESSION['update'] = 'Failed';
            }
        }else{
            $_SESSION['update'] = 'Failed';
        }
        header('Location:'.base_url.'pedido/detalle&id='.$id);
    }
    public function gestion(){
        Utils::logued();
        Utils::isAdmin();
        $admin = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        
        require_once 'views/pedido/mis_pedidos.php';
    }
}
?>