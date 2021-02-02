<?php

class Pedido {

    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $cod_postal;
    private $monto;
    private $telefono;
    private $estado;
    private $fecha;
    private $hora;
    //Conexion DDBB
    private $db;

    function __construct() {
        $this->db = Database::connect();
    }

    function getId() {
        return $this->id;
    }

    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getMonto() {
        return $this->monto;
    }

    function getEstado() {
        return $this->estado;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function getCodPostal() {
        return $this->cod_postal;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setMonto($monto) {
        $this->monto = $monto;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setCodPostal($cod) {
        $this->cod_postal = $cod;
    }

    function setTelefono($tel) {
        $this->telefono = $tel;
    }

    public function getAll() {
        $sql = "SELECT * FROM pedidos";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $productos = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $productos;
    }
    



    public function getOne() {
        $sql = "SELECT p.*, u.* FROM pedidos p "
                . "INNER JOIN usuarios u ON p.usuario_id = u.id "
                . "WHERE p.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':id' => $this->getId()));
        $producto = $stmt->fetch(PDO::FETCH_OBJ);

        return $producto;
    }
    
    public function getOneByUser(){
        $sql = "SELECT p.id, p.monto FROM pedidos p "
                . "WHERE usuario_id = :usuario_id "
                . "ORDER BY id DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':usuario_id' => $this->getUsuario_id()));
        $pedido = $stmt->fetch(PDO::FETCH_OBJ);

        return $pedido;
    }
    
    public function getAllByUser(){
        $sql = "SELECT p.* FROM pedidos p "
//                . "INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
                . "WHERE p.usuario_id = :usuario_id "
                . "ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':usuario_id' => $this->getUsuario_id()));
        $pedido = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $pedido;
    }
    
    public function getProductosByPedido($id){
//        $sql = "SELECT * FROM productos WHERE id IN "
//                . "(SELECT producto_id FROM lineas_pedidos WHERE pedido_id={$id})";
        
        $sql = "SELECT pr.*, t.unidades FROM productos pr "
                . "INNER JOIN transacciones t ON pr.id = t.producto_id "
                . "WHERE t.pedido_id = {$id}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $productos = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        // //actualizamos el stock del producto restando las unidades pedidas
        // $query = "UPDATE productos pr INNER JOIN transacciones t ON pr.id = t.producto_id SET pr.stock = (pr.stock - t.unidades) WHERE t.pedido_id = {$id}"; 
        // $stmt = $this->db->prepare($query);
        // $stmt->execute();

        return $productos;
    }

    public function save() {
        $sql = "INSERT INTO pedidos VALUES(null, :usuario_id, :provincia, :localidad, :direccion, :cod_postal, :telefono, :monto, 'confirm', CURDATE(), CURTIME())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(
            ':usuario_id' => $this->getUsuario_id(),
            ':provincia' => $this->getProvincia(),
            ':localidad' => $this->getLocalidad(),
            ':direccion' => $this->getDireccion(),
            ':cod_postal' => $this->getCodPostal(),
            ':telefono' => $this->getTelefono(),
            ':monto' => $this->getMonto()
        ));
        $result = false;
        if ($stmt) {
            $result = true;
        }
        return $result;
    }
    
   
    
    public function edit() {
        $sql = "UPDATE pedidos SET estado = :estado WHERE id = :pedido_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':estado', $this->getEstado(), PDO::PARAM_STR);
        $stmt->bindParam(':pedido_id', $this->getId(), PDO::PARAM_INT);
        $stmt->execute();
       
        $result = false;
        if ($stmt) {
            $result = true;
        }
        return $result;
    }

}
