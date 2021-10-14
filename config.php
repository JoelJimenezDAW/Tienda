<?php
//Datos de la base de dades//
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'usbw');
define('DB_NAME', 'database');


$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Comprueba la conexion 
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

//Se conecta a la base de datos//
function conectar() {
	$server = "localhost";
	$user = "root";
	$password = "usbw";
	$db = "database";
	try {
		$conn = new PDO("mysql:host=$server;dbname=$db", $user, $password, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	} catch (Exception $ex) {
		echo $ex->getMessage();
	}
}




