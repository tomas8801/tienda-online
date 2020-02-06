<?php
require_once 'models/usuario.php';
class usuarioController {
    public function index(){
        echo 'Controlador Usuarios, Accion index';
    }
    
    public function registro(){
        require_once 'views/usuario/registro.php';
    }
    
    public function save(){
        if (isset($_POST['submit'])) {
            //recogemos los datos del formulario
            $name = isset($_POST['name']) ? $_POST['name'] : false;
            $surname = isset($_POST['surname']) ? $_POST['surname'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            
            $errores = array();
            if (!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name)) {
                $nombre_validado = true;
            }else {
                $nombre_validado = false;
                $errores['nombre'] = "El nombre no es valido";
            }
            if (!empty($surname) && !is_numeric($surname) && !preg_match("/[0-9]/", $surname)) {
                $surname_validado = true;
            }else {
                $surname_validado = false;
                $errores['apellido'] = "El apellido no es valido";
            }
            if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_validado = true;
            }else {
                $email_validado = false;
                $errores['email'] = "El email no es valido";
            }
            if (!empty($password)) {
                $contraseña_validada = true;
            }else {
                $contraseña_validada = false;
                $errores['password'] = "La contraseña no es valida";
            }
            $guardar_usuario = false;
            if (count($errores) == 0) {
                $guardar_usuario= true;
                
                $usuario = new Usuario();
                $usuario->setNombre($name);
                $usuario->setApellido($surname);
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                $save = $usuario->save();
                if ($save) {
                    $_SESSION['register'] = 'complete';
                }else {
                    $_SESSION['register'] = 'failed';
                }
            }else {
                $_SESSION['errores']  = $errores;
            }
        }else {
            $_SESSION['register'] = 'failed';
        }
        header("Location: ".url_base."/usuario/registro");
    }
    
    public function login(){
        if (isset($_POST['submit'])) {
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            
            $errores = array();
            if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_validado = true;
            }else {
                $email_validado = false;
                $errores['email'] = "El email no es valido";
            }
            if (!empty($password)) {
                $contraseña_validada = true;
            }else {
                $contraseña_validada = false;
                $errores['password'] = "La contraseña no es valida";
            }
            
            $login_usuario = false;
            if (count($errores) == 0) {
                $login_usuario = true;
                $usuario = new Usuario();
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                
                $identity = $usuario->login();
                
                if ($identity && is_object($identity)) {
                    $_SESSION['identity'] = $identity;
                    if ($identity->rol == 'admin') {
                        $_SESSION['admin'] = true;
                    }
                }else {
                    $_SESSION['error_login'] = 'Identificacion fallida';
                }
                header("Location: ".url_base);
            }
            
        }
    }
    
    public function logout() {
        if (isset($_SESSION['identity'])) {
            $_SESSION['identity'] = null;
            unset($_SESSION['identity']);
        }
        if (isset($_SESSION['admin'])) {
            $_SESSION['admin'] = null;
            unset($_SESSION['admin']);
        }
        header("Location: ".url_base);
    }
}


