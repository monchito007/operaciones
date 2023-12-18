<?php
if(!isset($_SESSION['id'])){
    $_SESSION['page'] = 'list.php';
    header('Location: content.php');
}

/**********************************************************************

Titulo: delete.php
Autor: Moisés Aguilar Miranda
Fecha: 17/12/2020
Descripción: Página para mostrar el registro que se quiere eliminar.
Comentarios:
 
**********************************************************************/

?>
<?php

include 'functions/connect_db.php';
include 'functions/functions.php';

//phpinfo();

$id_operacion = $_SESSION["id"];
//echo "Id Session -> ".$_SESSION["id"];

$query = "SELECT a.fecha, a.operacion, a.activa, b.estado, b.id "
. "FROM operaciones as a, estados as b "
. "WHERE a.id_estado=b.id "
. "AND a.id=".$id_operacion;

$res_operacion = convertir_res_mysql_en_array(consulta_sql($query));

$query_estados = "SELECT * FROM estados";

$res_estados = consulta_sql($query_estados);

$query_seguimiento = "SELECT * FROM seguimientos WHERE id_operacion=".$id_operacion." ORDER BY fecha DESC";

$res_seguimiento = consulta_sql($query_seguimiento);

$query_notas = "SELECT * FROM notas WHERE id_operacion=".$id_operacion;

$res_notas = consulta_sql($query_notas);

//print_r($res_operacion);

//echo $query_notas;

?>

<div id="content2">
<div>
    <div id="detalles_operacion">
        
        <div id="title">

            <h3>Operación <?php echo OpActiva($res_operacion['activa']);?></h3>
            <h1><b><?php echo $res_operacion['operacion']; ?></b> - <i><?php echo $res_operacion['estado']; ?></i></h1>

        </div>       
        
        <form method="POST" action="save_operacion.php" enctype="multipart/form-data" onsubmit="return validar_form_operaciones(this)">
            
            <input id="id_operacion" name="id_operacion" type="hidden" value="<?php echo $id_operacion; ?>">
            
            <table>
                <tr>
                    <td>Operación</td>
                    <td><input type="text" id="operacion" name="operacion" value="<?php echo $res_operacion['operacion']; ?>" /></td>
                </tr>
                <tr>
                    <td>Estado</td>
                    <td>
                        <select id="select_estado" name="select_estado">
                            <option value=0 selected>Selecciona un estado...</option>
                        <?php

                            while ($row = mysqli_fetch_assoc($res_estados)) {

                                if($row["id"]==$res_operacion['id']){
                                    echo "<option value=".$row["id"]." selected>".$row["estado"]."</option>";
                                }else{
                                    echo "<option value=".$row["id"].">".$row["estado"]."</option>";
                                }
                            }

                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Activa</td>
                    <td>
                        <select id="select_activa" name="select_activa">
                            <option value=0 selected>Selecciona un estado...</option>
                        <?php

                            if($res_operacion['activa']==='1'){
                                echo "<option value=".$res_operacion['activa']." selected>Sí</option>";
                                echo "<option value=0>No</option>";
                            }else{
                                echo "<option value=".$res_operacion['activa']." selected>No</option>";
                                echo "<option value=1>Sí</option>";
                            }

                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" id="SubirBtn" name="SubirBtn" value="Modificar" />
                    </td>
                </tr>        
            </table>
        </form>
        <div id="errores_form_operaciones"></div>
    </div>
    
    <div id="notas">
        <table class="notas">                
                <?php
                    $count = 1;
                    while($datos = mysqli_fetch_assoc($res_notas)){

                        echo "<tr>";
                        echo "<th scope='row'><text class='cont'>".$count."</text></th>";                  
                        echo "<th scope='row'>".$datos["nota"]."</th>";                       
                        echo "<td>";
                        echo "<a href='page.php?page=delete_nota.php&id_nota=".$datos['id']."'><i class='fa-solid fa-trash'></i></a>";
                        echo "</td>";
                        echo "</tr>";
                        $count++;
                    }
                ?>             
        </table>
        <form method="POST" action="save_nota.php" enctype="multipart/form-data" onsubmit="return validar_form_notas(this)">
            <table>
                <tr>
                    <td colspan="2"><b>Notas</b></td>
                </tr>
                <tr>
                    <td><input id="id_operacion" name="id_operacion" type="hidden" value="<?php echo $id_operacion; ?>"></td>
                    <td><input type="text" id="nota" name="nota" placeholder="Añadir nueva nota..."/><input type="submit" id="SubirBtn" name="SubirBtn" value="Añadir" /></td>
                </tr>
            </table>
        </form>
        <div id="errores_form_notas"></div>
    </div>
</div>
    
    
    <div id="seguimiento">
        <div id="comentarios">
            <h3>Seguimiento</h3>
                <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Comentario</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while($datos = mysqli_fetch_assoc($res_seguimiento)){

                        echo "<tr>";
                        echo "<th scope='row'>".$datos["fecha"]."</th>";
                        echo "<td>".$datos["comentario"]."</td>";
                        echo "<td>";
                        //echo "<i class='fa-solid fa-xmark'></i>&nbsp&nbsp";
                        echo "<a href='page.php?page=edit_comentario.php&id_comentario=".$datos['id']."'><i class='fa-solid fa-pen-to-square'></i></a>&nbsp&nbsp";
                        echo "<a href='page.php?page=delete_comentario.php&id_comentario=".$datos['id']."'><i class='fa-solid fa-trash'></i></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>      
                </tbody>
            </table>
        </div>
        <div id="form_seguimiento">
            
            <form method="POST" action="save_comentario.php" enctype="multipart/form-data" onsubmit="return validar_form_seguimiento(this)">
                
                <input id="id_operacion" name="id_operacion" type="hidden" value="<?php echo $id_operacion; ?>">
                
                <table>
                    <tr>
                        <td>
                            <p><b>Nuevo comentario de seguimiento</b></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <textarea id="comentario" name="comentario" placeholder="Añadir nuevo comentario..."></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" id="SubirBtn" name="SubirBtn" value="Añadir comentario" />
                        </td>
                    </tr>
                </table>
            </form>
            <div id="errores_form_seguimiento"></div>
        </div>
    </div>
 
</div>
<script type="text/javascript">

function validar_form_operaciones(){
    
    var valido=true;
    
    document.getElementById("operacion").style.borderColor = "green";
    document.getElementById("select_estado").style.borderColor = "green";
    
    document.getElementById("errores_form_operaciones").innerHTML="<ul id='errores_operaciones' class='errores'></ul>";
    
    if(document.getElementById("operacion").value.length < 3){
        document.getElementById("errores_operaciones").innerHTML="<li>Debes introducir un nombre para la operación</li>";
        document.getElementById("operacion").style.borderColor = "red";
        valido=false;
    }
    
    if(document.getElementById("select_estado").value==="0"){
    document.getElementById("errores_operaciones").innerHTML+="<li>Debes seleccionar un estado.</li>";
    document.getElementById("select_estado").style.borderColor = "red";
    valido=false;
    }
        
    return valido;
    
}

</script>
<script type="text/javascript">

function validar_form_seguimiento(){
    
    var valido=true;
    
    document.getElementById("comentario").style.borderColor = "green";
    
    document.getElementById("errores_form_seguimiento").innerHTML="<ul id='errores_seguimientos' class='errores'></ul>";
    
    if(document.getElementById("comentario").value.length < 3){
        document.getElementById("errores_seguimientos").innerHTML="<li>Debes introducir un comentario</li>";
        document.getElementById("comentario").style.borderColor = "red";
        valido=false;
    }
        
    return valido;
    
}
</script>
<script type="text/javascript">

function validar_form_notas(){
    
    var valido=true;
    
    document.getElementById("nota").style.borderColor = "green";
    
    document.getElementById("errores_form_notas").innerHTML="<ul id='errores_notas' class='errores'></ul>";
    
    if(document.getElementById("nota").value.length < 3){
        document.getElementById("errores_notas").innerHTML="<li>Debes introducir una nota.</li>";
        document.getElementById("nota").style.borderColor = "red";
        valido=false;
    }
        
    return valido;
    
}
</script>
