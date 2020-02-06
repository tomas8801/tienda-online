<?php
//AUTOCARGA LOS CONTROLADORES
function controllers_autoload($classname){
    require 'controllers/'.$classname.'.php';
}
spl_autoload_register('controllers_autoload');