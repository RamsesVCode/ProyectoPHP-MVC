<?php
class Producto{
    private $id; 
    private $Categoria_id; 
    private $nombre; 
    private $descripcion; 
    private $precio; 
    private $stock; 
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;

    //CONSTRUCTOR PARA LA CONEXION
    public function __construct(){
        $this->db = Database::connect();
    }

    //GETTERS
    function getId(){
        return $this->id;
    }
    function getNombre(){
        return $this->nombre;
    }
    function getCategoria_id(){
        return $this->categoria_id;
    }
    function getDescripcion(){
        return $this->descripcion;
    }
    function getPrecio(){
        return $this->precio;
    }
    function getStock(){
        return $this->stock;
    }
    function getOferta(){
        return $this->oferta;
    }
    function getFecha(){
        return $this->fecha;
    }
    function getImagen(){
        return $this->imagen;
    }
    //SETTERS
    function setId($id){
        $this->id = $id;
    }
    function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    function setCategoria_id($categoria_id){
        $this->categoria_id = $this->db->real_escape_string($categoria_id);
    }
    function setDescripcion($descripcion){
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }
    function setPrecio($precio){
        $this->precio = $this->db->real_escape_string($precio);
    }
    function setStock($stock){
        $this->stock = $this->db->real_escape_string($stock);
    }
    function setOferta($oferta){
        $this->oferta = $this->db->real_escape_string($oferta);
    }
    function setFecha($fecha){
        $this->fecha = $fecha;
    }
    function setImagen($imagen){
        $this->imagen = $imagen;
    }

    //METODOS QUE INTERACTUAN CON LA BD
    public function getAll(){
        $sql = "SELECT * FROM productos ORDER BY id DESC;";
        $productos = $this->db->query($sql);
        $result = false;

        if($productos){
            $result = $productos;
        }
        return $result;
    }
    public function getRandom(){
        $sql = "SELECT * FROM productos ORDER BY RAND();";
        $productos = $this->db->query($sql);
        $result = false;

        if($productos){
            $result = $productos;
        }
        return $result;
    }
    public function save(){
        $sql = "INSERT INTO productos VALUES(NULL,{$this->getCategoria_id()},'{$this->getNombre()}','{$this->getDescripcion()}',{$this->getPrecio()},{$this->getStock()},NULL,CURDATE(),'{$this->getImagen()}');";
        $save = $this->db->query($sql);
        $result = false;

        if($save){
            $result = true;
        }
        return $result;
    }
    public function delete(){
        $sql = "DELETE FROM productos WHERE id = {$this->getId()};";
        $delete = $this->db->query($sql);
        $result = false;

        if($delete){
            $result = true;
        }
        return $result;
    }
    public function getOneById(){
        $sql = "SELECT * FROM productos WHERE id = {$this->getId()};";
        $producto = $this->db->query($sql);
        $result = false;

        if($producto){
            $result = $producto->fetch_object();
        }
        return $result;
    }
    public function update(){
        $sql = "UPDATE productos SET categoria_id = {$this->getCategoria_id()},nombre='{$this->getNombre()}',descripcion='{$this->getDescripcion()}',precio={$this->getPrecio()},stock={$this->getStock()},imagen='{$this->getImagen()}' WHERE id = {$this->getId()};";
        $update = $this->db->query($sql);
        $result = false;

        if($update){
            $result = true;
        }
        return $result;
    }
    public function getAllByCategoryId(){
        $sql = "SELECT * FROM productos WHERE categoria_id = {$this->getCategoria_id()};";
        $productos = $this->db->query($sql);
        $result = false;

        if($productos){
            $result = $productos;
        }
        return $result;
    }
}
?>