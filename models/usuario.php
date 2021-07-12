<?php
class Usuario{
    //ATRIBUTOS DE LA TABLA EN LA BD
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    private $db;

    //CONSTRUCTOR PARA LA CONEXION A LA BD
    public function __construct(){
        $this->db = Database::connect();
    }

    //METODOS GETTER Y SETTER
    //GETTER
    function getId(){
        return $this->id;
    }
    function getNombre(){
        return $this->nombre;
    }
    function getApellidos(){
        return $this->apellidos;
    }
    function getEmail(){
        return $this->email;
    }
    function getPassword(){
        return password_hash($this->password,PASSWORD_BCRYPT,['cost'=>4]);
    }
    function getRol(){
        return $this->rol;
    }
    function getImagen(){
        return $this->imagen;
    }
    //SETTER
    function setId($id){
        $this->id = $id;
    }
    function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    function setApellidos($apellidos){
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }
    function setEmail($email){
        $this->email = $this->db->real_escape_string($email);
    }
    function setPassword($password){
        $this->password = $this->db->real_escape_string($password);
    }
    function setRol($rol){
        $this->rol = $rol;
    }
    function setImagen($imagen){
        $this->imagen = $imagen;
    }

    //METODOS QUE INTERACTUAN CON LA BD
    public function save(){
        $sql = "INSERT INTO usuarios VALUES(NULL,'{$this->getNombre()}','{$this->getApellidos()}','{$this->getEmail()}','{$this->getPassword()}','user',NULL);";
        $save = $this->db->query($sql);
        $result = false;

        if($save){
            $result = true;
        }
        return $result;
    }
    public function login(){
        $sql = "SELECT * FROM usuarios WHERE email = '{$this->getEmail()}';";
        $login = $this->db->query($sql);

        if($login && $login->num_rows==1){
            $usuario = $login->fetch_object();
            $verify = password_verify($this->password,$usuario->password);
            $result = false;

            if($verify){
                $result = $usuario;
            }
            return $result;
        }
    }
}