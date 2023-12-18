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

$comentario = $_REQUEST['comentario'];

if(isset($_REQUEST['id_comentario'])){
    $id_comentario = $_REQUEST['id_comentario'];
    $query ="UPDATE seguimientos SET comentario='$comentario' WHERE seguimientos.id=$id_comentario;";
}
if(isset($_REQUEST['id_operacion'])){
    $id = $_REQUEST['id_operacion'];
    $query = "INSERT INTO seguimientos (id_operacion, comentario, fecha) VALUES ('$id', '$comentario',current_timestamp())";
}
/*    
}else{    
    $query = "INSERT INTO operaciones (id, fecha, operacion, id_estado, activa) VALUES (NULL, current_timestamp(), '$operacion', '$id_estado','$activa');";
}
*/
    
consulta_sql($query);

echo $query;

$_SESSION['page']='detalles_operacion.php';

echo "Id ->".$_SESSION['id'];
echo "<br>";
echo "Page ->".$_SESSION['page'];
echo "<br>";
echo "Id Comentario ->".$id_comentario;



//Redrirección Javascript
echo '<script type="text/javascript">window.location.href = "page.php?page=detalles_operacion.php&id='.$_SESSION['id'].'";</script>';

//El header de php no se puede usar para direccionar una página en cualquier punto. 
//Unicamente se puede utilizar si es exactamente la primera salida que se envía, 
//si no lo es no funcionará (por tanto no se puede usar en un punto intermedio de una web)
header('Location: content.php');
die();




?>
