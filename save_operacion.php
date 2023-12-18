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

$operacion = $_REQUEST['operacion'];
$id_estado = $_REQUEST['select_estado'];
$activa = $_REQUEST['select_activa'];



if(isset($_REQUEST['id_operacion'])){
    $id = $_REQUEST['id_operacion'];
    $query = "UPDATE operaciones SET operacion='$operacion', id_estado='$id_estado', activa='$activa' WHERE operaciones.id=$id;";
}else{    
    $query = "INSERT INTO operaciones (id, fecha, operacion, id_estado, activa) VALUES (NULL, current_timestamp(), '$operacion', '$id_estado','$activa');";
}

consulta_sql($query);

echo $query;

$_SESSION['id']=$id;
$_SESSION['page']='detalles_operacion.php';

//Redrirección Javascript
echo '<script type="text/javascript">window.location.href = "content.php";</script>';

//El header de php no se puede usar para direccionar una página en cualquier punto. 
//Unicamente se puede utilizar si es exactamente la primera salida que se envía, 
//si no lo es no funcionará (por tanto no se puede usar en un punto intermedio de una web)
header('Location: content.php');
die();

?>
