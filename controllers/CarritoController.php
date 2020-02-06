<?php
require_once 'models/Producto.php';
class carritoController {
    
    public function index(){
        if (isset($_SESSION['carrito'])) {
            $carrito = $_SESSION['carrito'];
        }
        

        require_once 'views/carrito/index.php';
    }
    
    public function add(){
        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
        }else {
            header("Location: ".url_base);
        }
        
        if (isset($_SESSION['carrito'])) {
            $counter = 0;
            foreach($_SESSION['carrito'] as $indice => $elemento){
                if ($elemento['id_producto'] == $producto_id) {
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $counter++;
                }
            }
        }
        if (!isset($counter) || $counter == 0) {
            //conseguir producto
            $producto = new Producto();
            $producto->setId($producto_id);
            $producto = $producto->getOne();
            
            //añadir al carrito
            if (is_object($producto)) {
                $_SESSION['carrito'][] = array(
                "id_producto" => $producto->id,
                "precio"      => $producto->precio,
                "unidades"    => 1,
                "producto"    => $producto
                );
            }          
        }        
        header("Location: ".url_base."carrito/index");
    }
    
    public function remove(){
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }
        header("Location: ".url_base."carrito/index");
    }
    
    public function delete_all(){
        unset($_SESSION['carrito']);
        header("Location: ".url_base."carrito/index");
    }
    
    public function up(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']++;
        }
        header("Location: ".url_base."carrito/index");
    }
    
    public function down(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;
            if ($_SESSION['carrito'][$index]['unidades'] == 0) {
                unset($_SESSION['carrito'][$index]);
            }
        }
        header("Location: ".url_base."carrito/index");
    }
}
