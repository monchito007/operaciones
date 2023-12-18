<?php

/**********************************************************************

Titulo: form.php
Autor: Moisés Aguilar Miranda
Fecha: 22/06/2022
Descripción: Formulario para editar las tasaciones.
Comentarios:
 
**********************************************************************/

?>
<?php

$id_estado = $_SESSION['id'];

include 'functions/connect_db.php';
include 'functions/functions.php';

$registro_estado = obtener_registro_por_id_sql("estados",$id_estado);

?>
<div id="title"><h1>Editar estado</h1></div>

<div id="content2">

    <form method="POST" action="save_estado.php" enctype="multipart/form-data" onsubmit="return validar_form(this)">
        
        <input id="id_estado" name="id_estado" type="hidden" value="<?php echo $registro_estado['id']; ?>">
        
        <table class="tabla" id="table_formulario">
            <tr>
                <td><label>Estado</label></td>
                <td><input type="text" id="estado" name="estado" maxlength="30" placeholder="Añadir nuevo estado..." value="<?php echo $registro_estado['estado']; ?>"/></td>
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
    
    document.getElementById("estado").style.borderColor = "green";
    
    document.getElementById("errores_form").innerHTML="<ul id='errores' class='errores'></ul>";
    
    if(document.getElementById("estado").value.length < 3){
        document.getElementById("errores").innerHTML="<li>Debes introducir un estado</li>";
        document.getElementById("estado").style.borderColor = "red";
        valido=false;
    }
        
    return valido;
    
}

</script>
