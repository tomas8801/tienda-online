<?php 

class Transaccion 
{



    public function save_transaccion(){
        //seleccionamos el id o clave primaria del ultimo registro insertado
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $pedido_id = $stmt->fetch(PDO::FETCH_OBJ)->pedido;
        
        foreach ($_SESSION['carrito'] as $elemento){
            $producto = $elemento['producto'];

            $insert = "INSERT INTO transacciones VALUES(null, :pedido_id, :producto_id, :unidades)";
            $stmt = $this->db->prepare($insert);
            $stmt->execute(array(
                ':pedido_id' => $pedido_id,
                ':producto_id' => $producto->id,
                ':unidades' => $elemento['unidades'],
            ));
        }

        $result = false;
        if ($stmt) {
            $result = true;
        }
        return $result;
    }
}