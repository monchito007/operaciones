<?php

/**********************************************************************

Titulo: form_estado.php
Autor: Moisés Aguilar Miranda
Fecha: 27/09/2022
Descripción: Formulario para añadir estados de operaciones.
Comentarios:
 
**********************************************************************/

?>
<?php

include 'functions/connect_db.php';
include 'functions/functions.php';

?>
<div id="title"><h1>Nuevo estado</h1></div>

<div id="content2">

    <form method="POST" action="save_estado.php" enctype="multipart/form-data" onsubmit="return validar_form(this)">
        <table class="tabla" id="table_formulario">
            <tr>
                <td><label>Estado</label></td>
                <td><input type="text" id="estado" name="estado" maxlength="30" placeholder="Añadir nuevo estado..."/></td>
            </tr>
            
            <tr>
                <td><input type="submit" id="SubirBtn" name="SubirBtn" value="Guardar" /></td>
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
