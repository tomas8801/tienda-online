<?php
use App\core\Database;

session_start();
ob_start();
require_once '../vendor/autoload.php';
require_once 'config/config.php';

Database::connect();



