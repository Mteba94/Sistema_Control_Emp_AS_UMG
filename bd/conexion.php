<?php

$servidor = "localhost"; //127.0.0.1
$baseDatos = "bd_logistic"; //nombre de la base de datos
$usuario = "root"; //usuario
$clave = ""; //password

//try catch

try {

	$conexion = new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario, $clave);
	//echo "Conexion exitosa";
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException  $ex) {

	//imprimo el mensaje si existe algun error
	echo $ex->getMessage();
	echo "Error en la conexion";
}
