<?php
require_once 'models/usuario.php';
class UsuarioController{
    public function index(){
        echo 'Controlador usuario, metodo index';
    }
    public function registro(){
        require_once 'views/usuario/registro.php';
    }
    public function save(){
        if(isset($_POST) && !empty($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            //ARRAY DE POSIBLES ERRORES
            $errores = array();

            //VALIDAMOS EL NOMBRE
            if(!$nombre || empty($nombre) || is_numeric($nombre) || preg_match('/[0-9]/',$nombre)){
                $errores['nombre'] = 'Nombre no valido';
            }
            //VALIDAMOS EL APELLIDO
            if(!$apellidos || empty($apellidos) || is_numeric($apellidos) || preg_match('/[0-9]/',$apellidos)){
                $errores['apellidos'] = 'apellidos no validos';
            }
            //VALIDAMOS EL EMAIL
            if(!$email || empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errores['email'] = 'Email no valido';
            }
            //VALIDAMOS EL PASSWORD
            if(!$password || empty($password)){
                $errores['password'] = 'Password no valido';
            }

            //VERIFICAMOS QUE NO HAYAN ERRORES
            if(empty($errores)){
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                //GUARDAMOS EL REGISTRO
                $save = $usuario->save();
                if($save){
                    $_SESSION['registro'] = 'Completed'; 
                }else{
                    $_SESSION['registro'] = 'Failed';
                }
            }else{
                $_SESSION['registro'] = 'Failed';
            }
        }else{
            $_SESSION['registro'] = 'Failed';
        }
        header('Location:'.base_url.'usuario/registro');
    }
    public function login(){
        if(isset($_POST) && !empty($_POST)){
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            
            //ARRAY DE POSIBLES ERRORES
            $errores = array();

            //VALIDAMOS EL EMAIL
            if(!$email || empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errores['email'] = 'Password no valido';
            }
            //VALIDAMOS EL PASSWORD
            if(!$password || empty($password)){
                $errores['password'] = 'Password no valido';
            }
            
            //VERIFICAMOS QUE NO HAYAN ERRORES
            if(empty($errores)){
                $usuario = new Usuario();
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                $identity = $usuario->login();
                if($identity){
                    $_SESSION['identity'] = $identity;
                }else{
                    $_SESSION['login'] = 'Failed';    
                }

                if($identity->rol=='admin'){
                    $_SESSION['admin'] = true;
                }

            }else{
                $_SESSION['login'] = 'Failed';
            }
        }else{
            $_SESSION['login'] = 'Failed';
        }
        header('Location:'.base_url);
    }
    public function exit(){
        Utils::deleteSession('identity');
        Utils::deleteSession('carrito');
        Utils::deleteSession('admin');
        header('Location:'.base_url);
    }
}
?>