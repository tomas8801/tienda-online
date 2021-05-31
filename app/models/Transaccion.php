<?php 
namespace App\models;

use App\controllers\carritoController;
use App\core\Database;
use PDO;

class Transaccion 
{
    protected $pago_id;
    protected $pedido_id;
    protected $monto;
    protected $tipo_pago;
    protected $estado;

    protected $db;

    
    function __construct() {
        $this->db = Database::connect();
        // $this->db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );

    }

    public function save_transaccion(){
        // //seleccionamos el id o clave primaria del ultimo registro insertado
        // $sql = "SELECT LAST_INSERT_ID() as 'pedido'";
        // $stmt = $this->db->prepare($sql);
        // $stmt->execute();
        // $pedido_id = $stmt->fetch(PDO::FETCH_OBJ)->pedido;

        
        $insert = "INSERT INTO transacciones VALUES(null, :pago_id, :pedido_id, :monto, :tipo_pago, :estado, CURRENT_TIMESTAMP)";
        $stmt = $this->db->prepare($insert);
        $stmt->bindParam(':pago_id', $this->pago_id, PDO::PARAM_INT);
        $stmt->bindParam(':pedido_id', $this->pedido_id, PDO::PARAM_INT);
        $stmt->bindParam(':monto',$this->monto, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_pago', $this->tipo_pago, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);

        $stmt->execute();

        $result = false;
        if ($stmt) {
            $result = true;
        }
        return $result;
    }

    public function pago_id($pago_id = null) {
        if(!is_null($pago_id)) {
            $this->pago_id = $pago_id;
        }
        return $this->pago_id;
    }

    public function pedido_id($pedido_id = null) {
        if(!is_null($pedido_id)) {
            $this->pedido_id = $pedido_id;
        }
        return $this->pedido_id;
    }


    public function monto($monto = null) {
        if(!is_null($monto)) {
            $this->monto = $monto;
        }
        return $this->monto;
    }


    public function tipo_pago($tipo_pago = null) {
        if(!is_null($tipo_pago)) {
            $this->tipo_pago = $tipo_pago;
        }
        return $this->tipo_pago;
    }


    public function estado($estado = null) {
        if(!is_null($estado)) {
            $this->estado = $estado;
        }
        return $this->estado;
    }

}
