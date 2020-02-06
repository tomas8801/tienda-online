<?php

require_once 'models/Producto.php';

class productoController {

    public function index() {
        $producto = new Producto();
        $productos = $producto->getRandom(3);
        require_once 'views/producto/destacados.php';
    }
    public function ver(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();

            require_once 'views/producto/ver.php';
        }
    }
    public function gestion() {
        Utils::isAdmin();
        $producto = new Producto;
        $productos = $producto->getAll();

        require_once 'views/producto/gestion.php';
    }

    public function crear() {
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }

    public function save() {
        Utils::isAdmin();
        if (isset($_POST)) {
            $nombre = isset($_POST['name']) ? $_POST['name'] : false;
            $descripcion = isset($_POST['description']) ? $_POST['description'] : false;
            $precio = isset($_POST['price']) ? $_POST['price'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['category']) ? $_POST['category'] : false;

            if ($nombre && $descripcion && $precio && $stock && $categoria) {
                $producto = new Producto;
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);
                //GUARDAR LA IMAGEN
                $file = $_FILES['image'];
                $filename = $file['name'];
                $mimetype = $file['type'];
                if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') {
                    if (!is_dir('uploads/images')) {
                        mkdir('uploads/images', 0007, true);
                    }
                    move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                    $producto->setImage($filename);
                }

                $save = $producto->save();
                if ($save) {
                    $_SESSION['producto'] = "Complete";
                } else {
                    $_SESSION['producto'] = "Failed";
                }
            } else {
                $_SESSION['producto'] = "Failed";
            }
        } else {
            $_SESSION['producto'] = "Failed";
        }
        header("Location: " . url_base . "producto/gestion");
    }

    public function editar() {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;
            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();

            require_once 'views/producto/crear.php';
        } else {
            header("Location: " . url_base . "producto/gestion");
        }
    }

    public function update() {
        if (isset($_POST)) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;
            $nombre = isset($_POST['name']) ? $_POST['name'] : false;
            $descripcion = isset($_POST['description']) ? $_POST['description'] : false;
            $precio = isset($_POST['price']) ? $_POST['price'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;


            if ($nombre && $descripcion && $precio && $stock) {
                $producto = new Producto;
                $producto->setId($id);
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);

                $filename = $image['name'];
                $mimetype = $image['type'];
                if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') {

                    move_uploaded_file($image['tmp_name'], 'uploads/images/' . $filename);
                    $producto->setImage($filename);
                }

                $editar = $producto->edit();
                if ($editar) {
                    $_SESSION['producto'] = "Complete";
                } else {
                    $_SESSION['producto'] = "Failed";
                }
                header("Location: " . url_base . "producto/gestion");
            } else {
                $_SESSION['producto'] = "Failed";
            }
        } else {
            $_SESSION['producto'] = "Failed";
        }
    }

    public function eliminar() {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);
            $delete = $producto->delete();
            if ($delete) {
                $_SESSION['delete'] = "Complete";
                header("Location: " . url_base . "producto/gestion");
            } else {
                $_SESSION['delete'] = "Failed";
            }
        } else {
            $_SESSION['delete'] = "Failed";
        }
        header("Location: " . url_base . "producto/gestion");
    }

}
