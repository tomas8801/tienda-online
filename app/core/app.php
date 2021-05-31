<?php 
namespace App\core;
use App\controllers;


class App {

    private $currentController = 'producto';
    private $currentMethod = 'index';
    private $params = [];

    public function __construct()
    {
        // Obtenemos la url
        $url = $this->getUrl();
        
        // Si existe un controlador como parametro...
        if(isset($url)) {
            $path = $_SERVER['DOCUMENT_ROOT'] .'/tienda-online/app/controllers/'. ucwords($url[0]) .'Controller.php';
            if(file_exists($path)) {

                // Lo seteamos como controlador actual
                $this->currentController = $url[0];

                unset($url[0]);
            } 
        }

        $controller = 'App\controllers\\'. $this->currentController .'Controller';
        $this->currentController = new $controller;


        if(isset($url[1])) {
            if(method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];
          
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }
    
    protected function getUrl() {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, "/");
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode("/", $url);
        
        return $url;
    }
}