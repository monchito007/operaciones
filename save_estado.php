<?php
session_start();
?>
<?php

/**********************************************************************

Titulo: save_form.php
Autor: Moisés Aguilar Miranda
Fecha: 14/12/2020
Descripción: Página para guardar los datos en la base de datos.
Comentarios:
 
**********************************************************************/

?>
<?php
//phpinfo();

include 'functions/connect_db.php';
include 'functions/functions.php';

$estado = $_POST["estado"];

if(isset($_REQUEST['id_estado'])){
    $id = $_REQUEST['id_estado'];
    $query = "UPDATE estados SET estado='$estado' WHERE id=$id;";
}else{
    $query = "INSERT INTO estados (estado) VALUES ('$estado');";
}

consulta_sql($query);

echo $query;



$_SESSION['page']='estados.php';

//Redrirección Javascript
echo '<script type="text/javascript">window.location.href = "content.php";</script>';

//El header de php no se puede usar para direccionar una página en cualquier punto. 
//Unicamente se puede utilizar si es exactamente la primera salida que se envía, 
//si no lo es no funcionará (por tanto no se puede usar en un punto intermedio de una web)
header('Location: content.php');
die();


?>
