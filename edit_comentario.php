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

    <form method="POST" action="save_comentario.php" enctype="multipart/form-data" onsubmit="return validar_form(this)">
        
        <input id="id_comentario" name="id_comentario" type="hidden" value="<?php echo $registro_seguimiento['id']; ?>">
        
        <table class="tabla" id="table_formulario">
            <tr>
                <td><label>Comentario</label></td>
            </tr>
            <tr>
                <td><textarea id="comentario" name="comentario" placeholder="Añadir comentario..."><?php echo $registro_seguimiento['comentario']; ?></textarea></td>
            </tr>
            <tr>
                <td><input type="submit" id="SubirBtn" name="SubirBtn" value="Modificar" /></td>
            </tr>
        </table>
    </form>

</div>
<div id="errores_form"></div>

<script type="text/javascript">

function validar_form(){
    
    var valido=true;
    
    document.getElementById("comentario").style.borderColor = "green";
    
    document.getElementById("errores_form").innerHTML="<ul id='errores' class='errores'></ul>";
    
    if(document.getElementById("comentario").value.length < 3){
        document.getElementById("errores").innerHTML="<li>Debes introducir un comentario</li>";
        document.getElementById("comentario").style.borderColor = "red";
        valido=false;
    }
        
    return valido;
    
}

</script>
