<?php

class Categoria {
    private $id;
    private $nombre;
    //Conexion DDBB
    private $db;
    
    function __construct() {
        $this->db = Database::connect();
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function getAll(){
        $sql = "SELECT * FROM categorias";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $categorias = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $categorias;
    }
    
    function getOne(){
        $sql = "SELECT * FROM categorias WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(':id' => $this->getId()));
        $categoria = $stmt->fetch(PDO::FETCH_OBJ);
        return $categoria;
    }


    public function save(){

        $stmt = $this->db->prepare("INSERT INTO categorias VALUES (null, :nombre)");
        $stmt->execute(array(
            ':nombre' => $this->getNombre()
        ));
        //$sql = "INSERT INTO usuarios VALUES (null,'{$this->getNombre()}','{$this->getApellido()}','{$this->getEmail()}','{$this->getPassword()}','user','null'";
        //$save = $this->db->query($sql);
        $result = false;
        if ($stmt) {
            $result= true;
        }
        return $result;       
    }
}