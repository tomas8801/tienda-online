<?php

use App\core\app;



require '../app/init.php';



require_once '../app/resources/views/layouts/header.php';
require_once '../app/resources/views/layouts/sidebar.php';


function show_error(){
    $error = new errorController();
    $error->index();
}

$app = new app;
// if (isset($_GET['controller'])) {
//     $nombre_controlador = $_GET['controller']. 'Controller';
// }else if(!isset($_GET['controller']) && !isset($_GET['action'])) {
//     $nombre_controlador = controller_default;

// }else {
//     show_error();
//     exit();
// }

// if (class_exists($nombre_controlador)) {
//     $controlador = new $nombre_controlador();
    
//     if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
//         $action = $_GET['action'];
//         $controlador->$action();
//     }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
//         $action_default = action_default;
//         $controlador->$action_default();
//     }else{
//         show_error();
//     }
// }else {
//     show_error();
// }


require_once '../app/resources/views/layouts/footer.php';
