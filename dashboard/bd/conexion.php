<?php 
/*class Conexion{   
    public static function Conectar() {        
        define('servidor', 'localhost');
        define('nombre_bd', 'progresardatos');
        define('usuario', 'root');
        define('password', '');                         
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');            
        try{
            $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_bd, usuario, password, $opciones);            
            return $conexion;
        }catch (Exception $e){
            die("El error de Conexión es: ". $e->getMessage());
        }
    }
}

$conexion = new mysqli("localhost", "root", "", "progresardatos");

if ($conexion->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}*/

$conexion = new PDO('mysql:host=localhost;dbname=progresardatos', 'root', '');