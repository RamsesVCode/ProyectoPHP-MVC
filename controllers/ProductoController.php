<?php
require_once 'models/producto.php';
class ProductoController{
    public function index(){
        $producto = new Producto();
        $productos = $producto->getRandom();
        require_once 'views/producto/destacados.php';
    }
    public function gestion(){
        Utils::logued();
        Utils::isAdmin();
        $producto = new Producto();
        $productos = $producto->getAll();
        require_once 'views/producto/gestion.php';
    }
    public function crear(){
        Utils::logued();
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }
    public function save(){
        Utils::logued();
        Utils::isAdmin();
        if(isset($_POST) && !empty($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false; 
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false; 
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false; 
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false; 
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false; 
            //RECIBIMOS LA IMAGEN
            $file = $_FILES['imagen'];
            $filename = $file['name'];
            $mimetype = $file['type'];

            //ARRAY DE POSIBLES ERRORES
            $errores = array();

            //VALIDAMOS EL NOMBRE
            if(!$nombre || empty($nombre)){
                $errores['nombre'] = 'Nombre no valido';
            }
            //VALIDAMOS LA DESCRIPCION
            if(!$descripcion || empty($descripcion)){
                $errores['descripcion'] = 'Descripcion no valida';
            }
            //VALIDAMOS EL PRECIO
            if(!$precio || empty($precio) || preg_match('/[A-Z]/',$precio)){
                $errores['precio'] = 'Precio no valido';
            }
            //VALIDAMOS EL STOCK
            if(!$stock || empty($stock) || preg_match('/[A-Z]/',$stock)){
                $errores['stock'] = 'Stock no valido';
            }
            //VALIDAMOS LA CATEGORIA
            if(!$categoria || !is_numeric($categoria)){
                $errores['categoria'] = 'Categoria no valida';
            }
            //VALIDAMOS LA IMAGEN
            if($mimetype!='image/jpg' && $mimetype!='image/jpeg' && $mimetype!='image/png' && $mimetype!='image/gif'){
                $errores['imagen'] = 'Formato de archivo no valido';
            }

            //VERIFICAMOS QUE NO HAYAN ERRORES
            if(empty($errores)){
                //CREAMOS EL OBJETO PRODUCTO
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);
                //ESTRUCTURA DIR PARA LA IMAGEN
                if(!is_dir('uploads/images')){
                    mkdir('uploads/images',0777,true);
                }
                move_uploaded_file($file['tmp_name'],'uploads/images/'.$filename);
                $producto->setImagen($filename);

                //GUARDAMOS LOS DATOS
                $save = $producto->save();
                if($save){
                    $_SESSION['producto'] = 'Completed';        
                }else{
                    $_SESSION['producto'] = 'Failed';    
                }
            }else{
                $_SESSION['producto'] = 'Failed';    
            }
        }else{
            $_SESSION['producto'] = 'Failed';
        }
        header('Location:'.base_url.'producto/gestion');
    }
    public function delete(){
        Utils::logued();
        Utils::isAdmin();
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $id = $_GET['id'];

            $producto = new Producto();
            $producto->setId($id);
            $prod = $producto->getOneById();
            
            //BORRAMOS EL PRODUCTO Y SU IMAGEN
            $delete = $producto->delete();
            $image_delete = unlink('uploads/images/'.$prod->imagen);

            if($delete && $image_delete){ 
                $_SESSION['delete'] = 'Completed';
            }else{
                $_SESSION['delete'] = 'Failed';
            }
        }else{
            header('Location:'.base_url.'producto/gestion');
        }
        header('Location:'.base_url.'producto/gestion');
    }
    public function editar(){
        Utils::logued();
        Utils::isAdmin();
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $id = $_GET['id'];

            $edit = true;
            $producto = new Producto();
            $producto->setId($id);
            $producto = $producto->getOneById();

            require_once 'views/producto/crear.php';
        }else{
            header('Location:'.base_url.'producto/gestion');
        }
    }
    public function update(){
        Utils::logued();
        Utils::isAdmin();
        if(isset($_POST) && !empty($_POST) && isset($_GET['id']) && is_numeric($_GET['id'])){
            $id = $_GET['id'];
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false; 
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false; 
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false; 
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false; 
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false; 
            //RECIBIMOS LA IMAGEN
            $file = $_FILES['imagen'];
            $filename = $file['name'];
            $mimetype = $file['type'];

            //ARRAY DE POSIBLES ERRORES
            $errores = array();

            //VALIDAMOS EL NOMBRE
            if(!$nombre || empty($nombre)){
                $errores['nombre'] = 'Nombre no valido';
            }
            //VALIDAMOS LA DESCRIPCION
            if(!$descripcion || empty($descripcion)){
                $errores['descripcion'] = 'Descripcion no valida';
            }
            //VALIDAMOS EL PRECIO
            if(!$precio || empty($precio) || preg_match('/[A-Z]/',$precio)){
                $errores['precio'] = 'Precio no valido';
            }
            //VALIDAMOS EL STOCK
            if(!$stock || empty($stock) || preg_match('/[A-Z]/',$stock)){
                $errores['stock'] = 'Stock no valido';
            }
            //VALIDAMOS LA CATEGORIA
            if(!$categoria || !is_numeric($categoria)){
                $errores['categoria'] = 'Categoria no valida';
            }
            //VALIDAMOS LA IMAGEN
            if($mimetype!='image/jpg' && $mimetype!='image/jpeg' && $mimetype!='image/png' && $mimetype!='image/gif'){
                $errores['imagen'] = 'Formato de archivo no valido';
            }

            //VERIFICAMOS QUE NO HAYAN ERRORES
            if(empty($errores)){
                //CREAMOS EL OBJETO PRODUCTO
                $producto = new Producto();
                $producto->setId($id);
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);
                //ESTRUCTURA DIR PARA LA IMAGEN
                if(!is_dir('uploads/images')){
                    mkdir('uploads/images',0777,true);
                }
                move_uploaded_file($file['tmp_name'],'uploads/images/'.$filename);
                $producto->setImagen($filename);

                //GUARDAMOS LOS DATOS
                $update = $producto->update();
                if($update){
                    $_SESSION['producto'] = 'Completed';        
                }else{
                    $_SESSION['producto'] = 'Failed';    
                }
            }else{
                $_SESSION['producto'] = 'Failed';    
            }
        }else{
            $_SESSION['producto'] = 'Failed';
        }
        header('Location:'.base_url.'producto/editar&id='.$id);
    }
    public function ver(){
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);
            $producto = $producto->getOneById();
            require_once 'views/producto/ver.php';
        }
    }
}
?>