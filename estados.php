<?php

/**********************************************************************

Titulo: estados.php
Autor: Moisés Aguilar Miranda
Fecha: 27/09/2022
Descripción: Página para listar los estados de la base de datos.
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
<div id="title"><h1>Estados</h1></div>

<div id="anadir"><p><a href="page.php?page=form_estado.php">+ Nuevo estado</a></p></div>

<div id="content2">
    <table class="table table-hover" id="tblData">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Estado</th>
                <th scope="col">Modificar</th>
            </tr>
        </thead>
        <tbody>
<?php
    while($datos = mysqli_fetch_array($result)){
        
        echo "<tr>";
        echo "<th scope='row'>".$datos[0]."</th>";
        echo "<td>".$datos[1]."</td>";
        echo "<td><a href='page.php?page=edit_estado.php&id=".$datos[0]."'><i class='fa-solid fa-pen-to-square'></i></a></td>";
        //echo "<td><a href='page.php?page=edit.php&id=".$datos[0]."'>Modificar</a><br><a href='page.php?page=delete.php&id=".$datos[0]."'>Eliminar</a></td>";
        echo "</tr>";
       
    }

?>      
        </tbody>
    </table>
    
</div>
<script type="text/javascript">

function validar_form(){
    
    var valido=true;
    
    var fecha_inicial = new Date(document.getElementById("fecha_inicial").value);
    var fecha_final = new Date(document.getElementById("fecha_final").value);
    
    document.getElementById("errores_form").innerHTML="<ul id='errores' class='errores'></ul>";
    
    if(fecha_inicial > fecha_final){
        
        document.getElementById("errores").innerHTML="<li>La fecha inicial no puede ser mayor que la final.</li>";
        document.getElementById("fecha_inicial").style.borderColor = "red";
        document.getElementById("fecha_final").style.borderColor = "red";
        
        return false;
        
    }else{
        
        return valido;
        
    }    
    
}

</script>
<script type="text/javascript">
$(document).ready(function(){

$("#form_busqueda").hide();

$("#buscar").click(function(){
 
 if($("#form_busqueda").is(":hidden")){
                $("#form_busqueda").show(1000);
                $("#busqueda").focus();
            } else{
                $("#form_busqueda").hide(1000);
            }
 
 
});

});//Final Document Ready Function
</script>