<?php
class Categoria{
    private $id;
    private $nombre;
    private $db;

    //CONSTRUCTOR
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
    //SETTERS
    function setId($id){
        $this->id = $id;
    }
    function setNombre($nombre){
        $this->nombre = $nombre;
    }

    function getAll(){
        $sql = "SELECT * FROM categorias ORDER BY id DESC;";
        $categorias = $this->db->query($sql);
        $result = false;

        if($categorias){
            $result = $categorias;
        }
        return $result;
    }
    public function save(){
        $sql = "INSERT INTO categorias VALUES(NULL,'{$this->getNombre()}');";
        $save = $this->db->query($sql);
        $result = false;

        if($save){
            $result = true;
        }
        return $result;
    }
    public function getOneById(){
        $sql = "SELECT * FROM categorias WHERE id = {$this->getId()} LIMIT 1;";
        $categoria = $this->db->query($sql);
        $result = false;

        if($categoria){
            $result = $categoria->fetch_object();
        }
        return $result;
    }
}

?>