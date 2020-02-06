<?php

class Usuario {
    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $password;
    private $rol;
    private $image;
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

    function getApellido() {
        return $this->apellido;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 4]);
    }

    function getRol() {
        return $this->rol;
    }

    function getImage() {
        return $this->image;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

    function setImage($image) {
        $this->image = $image;
    }
    
    public function save(){

        $stmt = $this->db->prepare("INSERT INTO usuarios VALUES (null, :nombre,:apellido,:email,:contrasenia,'user', null)");
        $stmt->execute(array(
            ':nombre' => $this->getNombre(),
            ':apellido' => $this->getApellido(),
            ':email' => $this->getEmail(),
            ':contrasenia' => $this->getPassword(),
        ));
        //$sql = "INSERT INTO usuarios VALUES (null,'{$this->getNombre()}','{$this->getApellido()}','{$this->getEmail()}','{$this->getPassword()}','user','null'";
        //$save = $this->db->query($sql);
        $result = false;
        if ($stmt) {
            $result= true;
        }
        return $result;       
    }
    
    public function login(){
        $result = false;
        $email = $this->email;
        $password = $this->password;
        
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = '$email'");
        $stmt->execute();
        
        //si es igual a una cantidad de registros que nos devuelve la consulta...
        if ($stmt && $stmt->rowCount() == 1 ) {
            $usuario = $stmt->fetchObject();
        //verificar la contraseña que llega del form con la encriptada del registro.
            $verify = password_verify($password, $usuario->password);
            
            if ($verify) {
                $result = $usuario;
            }
        }
        return $result;
        
    }

}