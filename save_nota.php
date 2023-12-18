<?php
session_start();
?>
<?php

/**********************************************************************

Titulo: save_nota.php
Autor: Moisés Aguilar Miranda
Fecha: 03/10/2022
Descripción: Página para guardar las notas en la base de datos.
Comentarios:
 
**********************************************************************/

?>
<?php
//phpinfo();

include 'functions/connect_db.php';
include 'functions/functions.php';

$nota = $_REQUEST['nota'];

if(isset($_REQUEST['id_operacion'])){
    $id = $_REQUEST['id_operacion'];
    $query = "INSERT INTO notas (id_operacion, nota) VALUES ('$id', '$nota')";
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
