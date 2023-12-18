<?php

$server = "localhost";
$user = "root";
$pass = "";
$bd = "tasaciones_db";

//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass,$bd) 
or die("Ha sucedido un error inexperado en la conexion de la base de datos");

//generamos la consulta
$sql = "SELECT * FROM municipios";
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($conexion, $sql)) die();

$clientes = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
	$id=$row['id'];
	$provincia_id=$row['provincia_id'];
	$municipio=$row['municipio'];
	$slug=$row['slug'];
	$latitud=$row['latitud'];
	$longitud=$row['longitud'];

	$municipios[] = array('id'=> $id, 'provincia_id'=> $provincia_id, 'municipio'=> $municipio, 'slug'=> $slug, 'latitud'=> $latitud, 'longitud'=> $longitud);

}
	
//desconectamos la base de datos
$close = mysqli_close($conexion) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

//Creamos el JSON
//$clientes['clientes'] = $clientes;
$json_string = json_encode($municipios);
echo $json_string;

//Si queremos crear un archivo json, sería de esta forma:
/*
$file = 'clientes.json';
file_put_contents($file, $json_string);
*/
	

?>