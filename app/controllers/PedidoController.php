<?php
namespace app\controllers;


use App\helpers\Utils;
use App\models\Pedido;

class pedidoController {
    public function hacer(){
        
        require_once '../app/resources/views/pedido/hacer.php';
    }
    
    public function add() {
        if (isset($_SESSION['identity'])) {
            $usuario_id = $_SESSION['identity']->id;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : null;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : null;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : null;
            $cod_postal = isset($_POST['cod_postal']) ? $_POST['cod_postal'] : null;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;

            
            $carrito = $_SESSION['carrito'];

            if ($provincia && $localidad && $direccion && $cod_postal && $telefono) {
                //guardar datos en bd
                foreach($carrito as $item) {
                    $pedido = new Pedido();
                    $pedido->setUsuario_id($usuario_id);
                    $pedido->productId($item['id_producto']);
                    $pedido->unidades($item['unidades']);
                    $pedido->setProvincia($provincia);
                    $pedido->setLocalidad($localidad);
                    $pedido->setDireccion($direccion);
                    $pedido->setCodPostal($cod_postal);
                    $pedido->setTelefono($telefono);
                    
                    $save = $pedido->save();
                }
               
       
                if ($save) {
                    $_SESSION['pedido'] = 'complete';
                    header("Location: ".url_base."pago/pagar");


                }else {
                    $_SESSION['pedido'] = 'failed';
                }
            }else {
                $_SESSION['pedido'] = 'failed';
            }


        }else {
            header("Location: ".url_base);
        }
    }
    
    public function confirmado(){
        if (isset($_SESSION['identity'])) {
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuario_id($identity->id);            
            $pedido = $pedido->getOneByUser();

            // $pedido_productos = new Pedido();
            // $productos = $pedido_productos->getProductosByPedido($pedido->id);

        }
        require_once '../app/resources/views/pedido/confirmado.php';
    }
    
    public function mis_pedidos(){
        Utils::isIdentity();
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();
        $pedido->setUsuario_id($usuario_id);
        $pedidos = $pedido->getAllByUser();
        require_once '../app/resources/views/pedido/mis_pedidos.php';
    }
    
    public function detalle(){
        Utils::isIdentity();
        if (isset($_GET['id'])) {
            $pedido_id = $_GET['id'];
            
            //sacar el pedido
            $pedido = new Pedido();
            $pedido->setId($pedido_id);
            $pedido = $pedido->getOne();
            
            //sacar los productos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($pedido_id);
            
            require_once '../app/resources/views/pedido/detalle.php';
        }else{
            header("Location: ".url_base);
        }
    }
    
    public function gestion(){
        Utils::isAdmin();
        $gestion = true;
        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        
        require_once '../app/resources/views/pedido/mis_pedidos.php';
    }
    
    public function estado(){
        Utils::isAdmin();
        if(isset($_POST['pedido_id']) && isset($_POST['estado'])) {
            //Recoger datos del form
            $pedido_id = $_POST['pedido_id'];
            $estado = $_POST['estado'];
            
            //Update del pedido
            $pedido = new Pedido();
            $pedido->setId($pedido_id);
            $pedido->setEstado($estado);
            $pedido->edit();
            
            header("Location: ".url_base."pedido/detalle&id=".$pedido_id);
        }else{
            header("Location: ".url_base);
        }
    }
    
   
    
}