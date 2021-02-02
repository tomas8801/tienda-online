<?php


class pagoController 
{

	public function __construct()
	{

	}

	public function pagar()
	{
		echo 'Metodo pagar';
		// echo $this->getAccessToken();
		$orden =  $this->crearOrden($this->getAccessToken(), $this->items());
		var_dump($orden);
		// var_dump($_SESSION['identity']);

	}

	public function crearOrden(string $accessToken,  $products)
	{	
		$products = $this->items();

		
		$amountObject = new stdClass();
		$amountObject->currency = 'USD';
		$amountObject->total = (string)Utils::statsCarrito()['total'];

		$itemListObject = new stdClass();
		$itemListObject->items = array_values($products);

		$objeto = new stdClass();
		$objeto->amount = $amountObject;
		$objeto->item_list = $itemListObject;
		

		$data = [
			"intent" => "SALE",
			"payer" => [
				"payment_method" => "paypal"
			],
			"transactions" => [
				$objeto
			],
			"redirect_urls" => [
				"return_url" => url_base.'pago/paymentComplete',
				"cancel_url" => url_base.'carrito/index'
			]
		];
		$dataString = json_encode($data, 320);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v1/payments/payment');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

		$headers = array();
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Authorization: Bearer '.$accessToken;
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}

		curl_close($ch);

		$data = json_decode($result, true);
	
		if($data['state'] !== 'created') {
			return false;
		}

		$this->payPalOrderId($data['id']);
		$url = '';
		foreach($data['links'] as $link) {
			if($link['rel'] == 'approval_url') {
				$url = $link['href'];
				header("Location: ".$url);	
			}
			$_SESSION['pago_resultado'] = 'Hubo un problema al generar tu compra.';

		}
		$_SESSION['pago_resultado'] = 'Tu compra ha sido exitosa. Te hemos enviado un email a tu correo con los detalles de la misma.';
		
		
	}

	private function items()
	{
		if(isset($_SESSION['carrito'])) {
			$carrito = $_SESSION['carrito'];

			$items = array_map(function($product){
				return [
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

	private function getAccessToken()
	{

		if(isset($_SESSION['payPalAccessToken']) && isset($_SESSION['payPalAccessTokenExpires']) && $_SESSION['payPalAccessTokenExpires'] > time()) {
			return $_SESSION['payPalAccessToken'];
		}

		echo 'Bienn';
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v1/oauth2/token');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
		curl_setopt($ch, CURLOPT_USERPWD, 'AWuB66jnKtuPKAish64LbhnGNwQDpitF3X1Lc0WPtBfDXemiWXbQ7EEIfI6CKxjxBG2C0sW-fLt21SsJ' . ':' . 'EB6_onyprr8S_kdRijB0yIfyEF-Q2ApZOMobVw8UjJL99gnILJwdmzKI1Oj9gdVRN4TRqGuWz07O3q-w');
		
		$headers = array();
		$headers[] = 'Accept: application/json';
		$headers[] = 'Accept-Language: en_US';
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		$result = curl_exec($ch);

		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		$data = json_decode($result, true);
		$accessToken = $data['access_token'];
		$_SESSION['payPalAccessToken'] = $accessToken;
		$_SESSION['payPalAccessTokenExpires'] = time()+$data['expires_in'];

		return $accessToken;
	}

	public function payPalOrderId(string $orderId = null){
		if(!is_null($orderId)) {
			$_SESSION['payPalOrderId'] = $orderId;
		}
		return $_SESSION['payPalOrderId'];
	}
	public function payPalRequestId(string $requestId = null){
		!is_null($requestId) ? $_SESSION['payPalRequestId'] = $requestId : $_SESSION['payPalRequestId'];
	}

	public function capturePayment(string $accessToken, string $orderId, $token) {
		
		$data = new stdClass();
		$data->payment_source = new stdClass();
		$data->payment_source->token = new stdClass();
		$data->payment_source->token->id = $token;
		$data->payment_source->token->type = 'BILLING_AGREEMENT';

		$dataString = json_encode($data, 320);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v2/checkout/orders/'.$orderId.'/capture');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

		$headers = array();
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Authorization: Bearer '.$accessToken;
		// $headers[] = 'PayPal-Request-Id '.$payPalRequestId;
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}

		curl_close($ch);

		$data = json_decode($result, true);
		var_dump($data);
	}




	public function paymentComplete()
	{

		$accessToken = $this->getAccessToken();
		$orderId = $this->payPalOrderId();
		// $orderToken = $this->orderToken();

		// $requestId = $this->payPalRequestId();
		$url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
		$token = substr($url,92,20);
		// echo 'accessToken: '. $accessToken;
		// echo 'orderId: '. $orderId;
		// echo 'token: '. $token;

		// $payerId = filter_input(INPUT_GET, 'PayerID', FILTER_SANITIZE_STRING);
		
		if($accessToken && $orderId && $token) {
			$this->capturePayment($accessToken, $orderId, $token);

		}

	
		require_once './views/pago/exitoso.php';
	}

	public function error()
	{
		require_once './views/pago/fail.php';
	}
}
