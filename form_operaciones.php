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

$query = "SELECT * " 
."FROM estados "
."ORDER BY estado ASC";


$result = consulta_sql($query);

?>
<div id="title"><h1>Nueva operación</h1></div>

<div id="content2">

    <form method="POST" action="save_operacion.php" enctype="multipart/form-data" onsubmit="return validar_form(this)">
        <table class="tabla" id="table_formulario">
            <tr>
                <td><label>Operación</label></td>
                <td><input type="text" id="operacion" name="operacion" maxlength="100" placeholder="Añadir nueva operación..."/></td>
            </tr>
            
            <tr>
                <td><label>Estado</label></td>
                <td>
                <select id="select_estado" name="select_estado">
                    <option value=0>Selecciona un estado...</option>
                    <?php
                        while($datos = mysqli_fetch_array($result)){                   
                        echo "<option value=$datos[0]>".$datos[1]."</option>";
                        }
                    ?>
                </select>
                </td>
            </tr>
            <tr>
                <td><label>Activa</label></td>
                <td>
                <select id="select_activa" name="select_activa">
                    <option value=1 selected>Sí</option>
                    <option value=0>No</option>
                </select>
                </td>
            </tr>
            
            <tr>
                <td><input type="submit" id="SubirBtn" name="SubirBtn" value="Subir" /></td>
            </tr>
        </table>
    </form>

</div>
<div id="errores_form"></div>

<script type="text/javascript">

function validar_form(){
    
    var valido=true;
    
    document.getElementById("operacion").style.borderColor = "green";
    document.getElementById("select_estado").style.borderColor = "green";
    
    document.getElementById("errores_form").innerHTML="<ul id='errores' class='errores'></ul>";
    
    if(document.getElementById("operacion").value.length < 3){
        document.getElementById("errores").innerHTML="<li>Debes introducir un estado</li>";
        document.getElementById("operacion").style.borderColor = "red";
        valido=false;
    }
    
    if(document.getElementById("select_estado").value==="0"){
    document.getElementById("errores").innerHTML+="<li>Debes seleccionar un estado.</li>";
    document.getElementById("select_estado").style.borderColor = "red";
    valido=false;
    }
        
    return valido;
    
}

</script>
