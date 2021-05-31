<?php
namespace app\controllers;

use App\helpers\Utils;
use App\models\Producto;
use App\models\Categoria;

class categoriaController {
    public function index(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();


        require_once '../app/resources/views/categoria/index.php';
    }
    
    public function crear(){
        Utils::isAdmin();
        require_once '../app/resources/views/categoria/crear.php';
    }
    
    public function ver(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //conseguir categoria
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne();
            //conseguir productos
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategory();
        }
        require_once '../app/resources/views/categoria/ver.php';
    }
    public function save(){
        Utils::isAdmin();
        if (isset($_POST['create']) && isset($_POST['name'])) {
            $nombre = $_POST['name'];
            
            $errores = array();
            if (!empty($nombre)) {
                $nombre_validado = true;
            }else {
                $nombre_validado = false;
                $errores['nombre'] = "El nombre no es valido";
            }
            
            if (count($errores) == 0) {
                $categoria = new Categoria();
                $categoria->setNombre($nombre);
                $save = $categoria->save();
                
                if ($save) {
                    $_SESSION['creacion'] = "complete";
                    header("Location: ".url_base."categoria/index");
                } else {
                    $_SESSION['creacion'] = "failed";
                }
                
            }else {
                $_SESSION['errores'] = $errores;
            }
            
        }else {
            $_SESSION['creacion'] = "failed";
        }
        header("Location: ".url_base."categoria/index");
    }
}

