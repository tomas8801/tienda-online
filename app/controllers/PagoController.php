<?php
namespace app\controllers;

use Exception;
use MercadoPago;
use App\helpers\Utils;
use App\models\Transaccion;

class pagoController 
{
	private $accessToken = 'TEST-7036590346736295-051920-28558ccae9992fd1322f677a9a1092b0-762077416';

	public function __construct()
	{
			// Agrega credenciales
			MercadoPago\SDK::setAccessToken($this->accessToken());
	}	

	public function index()
	{
		echo json_encode('Holaaa');
	}

	public  function pagar()
	{

		$products = $this->items();


		$preference = new MercadoPago\Preference();

		

		$items = array();
		foreach($products as $product) {
			$item = new MercadoPago\Item();
		
			$item->title = $product['name'];
			$item->quantity = $product['quantity'];
			$item->unit_price = $product['price'];
			
			$items[] = $item;
		};
		$preference->items = $items;

		$preference->back_urls = array(
            "success" => url_base."pago/success",
            "failure" => "http://localhost:8080/failure", 
            "pending" => "http://localhost:8080/pending"
        );

	
		// echo '<script>alert("caca")</script>';

		
		$preference->save();

		$response = array(
            'id' => $preference->id,
        ); 

		$_SESSION['preference'] = json_encode($response);
		header("Location: ".url_base."pedido/confirmado");

	

		// curl -X POST -H "Content-Type: application/json" -H 'Authorization: Bearer TEST-4299890927644663-060114-9922c825da6810b64659de131bbf27f2-263742680' "https://api.mercadopago.com/users/test_user" -d '{"site_id":"MLA"}'
		// // Vendedor
		// {"id":762077416,"nickname":"TESTA6GNZKKI","password":"qatest5386","site_status":"active","email":"test_user_8717949@testuser.com"}
		// // Comprador
		// {"id":762077466,"nickname":"TESTHMFFBOPH","password":"qatest1868","site_status":"active","email":"test_user_13270392@testuser.com"}
	}

	protected function accessToken($accessToken = null) {
		if(!is_null($accessToken)) {
			$this->accessToken = $accessToken;
		}
		return $this->accessToken;
	}


	private function items()
	{
		if(isset($_SESSION['carrito'])) {
			$carrito = $_SESSION['carrito'];

			$items = array_map(function($product){
				return [
					'id' => $product['producto']->id,
					'name' => $product['producto']->nombre,
					'description' => $product['producto']->descripcion,
					'price' => $product['precio'],
					'quantity' => (string)$product['unidades'],
					'currency' => 'USD'
				];
			}, $carrito);

			// $items = [];
			// foreach($carrito as $index => $producto) {
			// 	$items[$index] = $producto;
			// }

			return $items;

		}
	}

	public function success() 
	{
	 	if($_GET['collection_status'] != 'approved') {
			throw new Exception('Error.');
		}
		// echo 'pedido';
		// echo var_dump((int)$_SESSION['pedido_id']);
		// die();
		$stats = Utils::statsCarrito();
		$monto = $stats['total'];


		$transaction = new Transaccion();
		$transaction->pago_id((int)$_GET['payment_id']);
		$transaction->pedido_id((int)$_SESSION['pedido_id']);
		$transaction->monto((int)$monto);



		$transaction->tipo_pago($_GET['payment_type']);
		$transaction->estado($_GET['collection_status']);
		
		$save = $transaction->save_transaccion();

		if($save) {
			header('Location: http://localhost/tienda-online/');

		}

	}

	
}
