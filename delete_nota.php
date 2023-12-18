<?php

/**********************************************************************

Titulo: edit_comentario.php
Autor: Moisés Aguilar Miranda
Fecha: 29/09/2022
Descripción: Formulario para editar los comentarios de seguimiento.
Comentarios:
 
**********************************************************************/

?>
<?php

$id_nota = $_SESSION['id_nota'];

include 'functions/connect_db.php';
include 'functions/functions.php';

$query = "DELETE FROM notas WHERE id=".$_SESSION["id_nota"];

//echo $query;


//phpinfo();


consulta_sql($query);

$_SESSION['page']='detalles_operacion.php';
header('Location: content.php');

?>