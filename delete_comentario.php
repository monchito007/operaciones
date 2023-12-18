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

$id_comentario = $_SESSION['id_comentario'];

include 'functions/connect_db.php';
include 'functions/functions.php';

$query = "SELECT b.id, a.operacion, b.comentario FROM operaciones as a, seguimientos as b WHERE b.id_operacion=a.id AND b.id=".$id_comentario;

$registro_seguimiento = convertir_res_mysql_en_array(consulta_sql($query));

//$_SESSION['id'] = $registro_seguimiento['id_operacion'];

?>
<div id="title">
    <h1>Editar comentario</h1>
    <h3>Operación de <?php echo $registro_seguimiento['operacion'];?></h3>
</div>

<div id="content2">

    <form method="POST" action="delete.php" enctype="multipart/form-data">
        
        <input id="id_comentario" name="id_comentario" type="hidden" value="<?php echo $registro_seguimiento['id']; ?>">
        
        <table class="tabla" id="table_formulario">
            <tr>
                <td><label>Comentario</label></td>
            </tr>
            <tr>
                <td><h3><?php echo $registro_seguimiento['comentario']; ?></h3></td>
            </tr>
            <tr>
                <td><input type="submit" id="SubirBtn" name="SubirBtn" value="Eliminar" /></td>
            </tr>
            <tr>
                <td><input type="button" id="VolverBtn" name="VolverBtn" value="Volver" onclick="volver()"/></td>
            </tr>
        </table>
    </form>

</div>


<div id="errores_form"></div>

<script type="text/javascript">

function volver(){
    
    window.location.href = "page.php?page=detalles_operacion.php&id=" + <?php echo $_SESSION['id']; ?>;
    
    return;
    
}

</script>
