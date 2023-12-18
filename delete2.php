<?php
session_start();
$id = $_REQUEST['id'];
?>
<?php
/**********************************************************************

Titulo: delete2.php
Autor: Moisés Aguilar Miranda
Fecha: 17/12/2020
Descripción: Página para eliminar la tasación de la base de datos.
Comentarios:
 
**********************************************************************/

?>
<?php
//phpinfo();

include 'functions/connect_db.php';
include 'functions/functions.php';

$query = "DELETE FROM tasaciones WHERE id=".$id;

$path = 'docs/'.$id.'/';
$file = $path.$id.'.pdf';
        
if(consulta_sql($query)){
    unlink($file);
    rmdir($path);
}

$_SESSION['page']='list.php';
header('Location: content.php');

?>