<?php

class Producto {

    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $image;
    //Conexion DDBB
    private $db;

    function __construct() {
        $this->db = Database::connect();
    }

    function getId() {
        return $this->id;
    }

    function getCategoria_id() {
        return $this->categoria_id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getStock() {
        return $this->stock;
    }

    function getOferta() {
        return $this->oferta;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getImage() {
        return $this->image;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCategoria_id($categoria_id) {
        $this->categoria_id = $categoria_id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setStock($stock) {
        $this->stock = $stock;
    }

    function setOferta($oferta) {
        $this->oferta = $oferta;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setImage($image) {
        $this->image = $image;
    }

    public function getAll() {
        $sql = "SELECT * FROM productos";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $productos = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $productos;
    }

    public function getAllCategory() {
        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
        . "INNER JOIN categorias c ON c.id = p.categoria_id "
        . "WHERE p.categoria_id = :categoria "
        . "ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':categoria' => $this->getCategoria_id()));
        $productos = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $productos;
    }

    public function getRandom($limit) {
        $sql = "SELECT * FROM productos WHERE stock > 0 ORDER BY RAND() LIMIT $limit";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $productos = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $productos;
    }

    public function getOne() {
        $sql = "SELECT * FROM productos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':id' => $this->getId()));
        $producto = $stmt->fetch(PDO::FETCH_OBJ);

        return $producto;
    }

    public function save() {
        $sql = "INSERT INTO productos VALUES(null, :categoria_id, :nombre, :descripcion, :precio, :stock, null, CURDATE(), :image)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(
            ':categoria_id' => $this->getCategoria_id(),
            ':nombre' => $this->getNombre(),
            ':descripcion' => $this->getDescripcion(),
            ':precio' => $this->getPrecio(),
            ':stock' => $this->getStock(),
            ':image' => $this->getImage(),
        ));
        $result = false;
        if ($stmt) {
            $result = true;
        }
        return $result;
    }

    public function delete() {
        $sql = "DELETE FROM productos WHERE id = :id ";
        $stmt = $this->db->prepare($sql);
        $id = $this->getId();
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = false;
        if ($stmt) {
            $result = true;
        }
        return $result;
    }

    public function edit() {
        $sql = "UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, stock = :stock";
        if ($this->getImage() != null) {
            $sql .= ", image = :image";
        }
        $sql .= " WHERE id= :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(
            ':id' => $this->getId(),
            ':nombre' => $this->getNombre(),
            ':descripcion' => $this->getDescripcion(),
            ':precio' => $this->getPrecio(),
            ':stock' => $this->getStock(),
            ':image' => $this->getImage(),
        ));

        $result = false;
        if ($stmt) {
            $result = true;
        }
        return $result;
    }
    
//    ------------------------------------------
    public function updateStock() {    
        $sql = "UPDATE productos pr INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id SET pr.stock = :stock";
        $stmt = $this->db->prepare($sql);
        $stock = $this->getStock();
        $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
        $stmt->execute();   
    }
}
