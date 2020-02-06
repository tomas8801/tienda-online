<?php

class Database{
    public static function connect(){
        try {
            //Mysqli MODE
            $db = new PDO("mysql:host=localhost;dbname=tienda_equilibre", "root", "");
            //$db = new mysqli("localhost", "root", "", "tienda_equilibre");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //if ($db->connect_errno) {
            //   echo 'Fallo en la conexion'. $db->errno;
            //}
            $db->exec("SET CHARACTER SET utf8");
            //$db->set_charset("utf8");
        } catch (PDOException $e) {
            die("Error en la conexion: " . $e->getMessage());
        }
        return $db;
    }
}