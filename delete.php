<?php
session_start();
?>
<?php
/**********************************************************************

Titulo: delete.php
Autor: Moisés Aguilar Miranda
Fecha: 30/09/2022
Descripción: Página para eliminar comentario de la base de datos.
Comentarios:
 
**********************************************************************/

?>
<?php
//phpinfo();

include 'functions/connect_db.php';
include 'functions/functions.php';

$query = "DELETE FROM seguimientos WHERE id=".$_SESSION['id_comentario'];

consulta_sql($query);

$_SESSION['page']='detalles_operacion.php';
header('Location: content.php');

?>