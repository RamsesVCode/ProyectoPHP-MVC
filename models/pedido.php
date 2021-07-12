<?php 
class Pedido{
    private $id;
    private $id_usuario;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    //METODOS GETTER
    function getId(){
        return $this->id;
    }
    function getId_usuario(){
        return $this->id_usuario;
    }
    function getProvincia(){
        return $this->provincia;
    }
    function getLocalidad(){
        return $this->localidad;
    }
    function getDireccion(){
        return $this->direccion;
    }
    function getCoste(){
        return $this->coste;
    }
    function getEstado(){
        return $this->estado;
    }
    function getFecha(){
        return $this->fecha;
    }
    function getHora(){
        return $this->hora;
    }
    //METODOS SETTER
    function setId($id){
        $this->id = $id;
    }
    function setId_suario($id_usuario){
        $this->id_usuario = $id_usuario;
    }
    function setProvincia($provincia){
        $this->provincia = $provincia;
    }
    function setLocalidad($localidad){
        $this->localidad = $localidad;
    }
    function setDireccion($direccion){
        $this->direccion = $direccion;
    }
    function setCoste($coste){
        $this->coste = $coste;
    }
    function setEstado($estado){
        $this->estado = $estado;
    }
    function setFecha($fecha){
        $this->fecha = $fecha;
    }
    function setHora($hora){
        $this->hora = $hora;
    }

    public function save(){
        $sql = "INSERT INTO pedidos VALUES(NULL,{$this->getId_usuario()},'{$this->getProvincia()}','{$this->getLocalidad()}','{$this->getDireccion()}',{$this->getCoste()},'Pendiente',CURDATE(),CURTIME());";
        $save = $this->db->query($sql);
        $result = false;

        if($save){
            $result = true;
        }
        return $result;
    }
    public function save_linea(){
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;
        $result = false;

        foreach($_SESSION['carrito'] as $valor){
            $sql = "INSERT INTO lineas_pedidos VALUES(NULL,$pedido_id,{$valor['id_producto']},{$valor['unidades']});";
            $save = $this->db->query($sql);
            if($save){
                $result = true;
            }
        }
        return $result;
    }
    public function getOneByUser(){
        $sql = "SELECT * FROM pedidos WHERE usuario_id = {$this->getId_usuario()} ORDER BY id DESC LIMIT 1;";
        $pedido = $this->db->query($sql);
        $result = false;

        if($pedido){
            $result = $pedido->fetch_object();
        }
        return $result;
    }
    public function getProductoByPedidoId($ped){
        $sql = "SELECT p.*, lp.unidades FROM productos p
            JOIN lineas_pedidos lp ON(p.id = lp.producto_id)
            WHERE lp.pedido_id = $ped;";
        $productos = $this->db->query($sql);
        $result = false;

        if($productos){
            $result = $productos;
        }
        return $result;
    }
    public function getAllByUser(){
        $sql = "SELECT * FROM pedidos WHERE usuario_id = {$this->getId_usuario()} ORDER BY id DESC;";
        $pedidos = $this->db->query($sql);
        $result = false;

        if($pedidos){
            $result = $pedidos;
        }
        return $result;
    }
    public function getOneById(){
        $sql = "SELECT * FROM pedidos WHERE id = {$this->getId()};";
        $pedido = $this->db->query($sql);
        $result = false;

        if($pedido){
            $result = $pedido->fetch_object();
        }
        return $result;
    }
    public function update(){
        $sql = "UPDATE pedidos SET estado = '{$this->getEstado()}' WHERE id = {$this->getId()};";
        $pedido = $this->db->query($sql);
        $result = false;

        if($pedido){
            $result = true;
        }
        return $result;
    }
    public function getAll(){
        $sql = "SELECT * FROM pedidos ORDER BY id DESC;";
        $pedidos = $this->db->query($sql);
        $result = false;

        if($pedidos){
            $result = $pedidos;
        }
        return $result;
    }
}
?>