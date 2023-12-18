<?php

/**********************************************************************

Titulo: list.php
Autor: Moisés Aguilar Miranda
Fecha: 15/12/2020
Descripción: Página para listar los datos en la base de datos.
Comentarios:
 
**********************************************************************/

?>
<?php
include 'functions/connect_db.php';
include 'functions/functions.php';

if(!isset($_SESSION['order'])){
    $order = 'ASC';
}else{
    $order = $_SESSION['order'];
    
    if($order=="ASC"){$order="DESC";}
    else{$order="ASC";}
}

if(isset($_REQUEST['orderby'])){
    
    switch ($_REQUEST['orderby']) {
        case "id":
            $orderby = "a.id";
            break;
        case "operacion":
            $orderby = "a.operacion";
            break;
        case "fecha":
            $orderby = "a.fecha";
            break;
        case "estado":
            $orderby = "b.estado";
            break;
        case "comentario":
            $orderby = "c.comentario";
            break;
        case "ultimo_seguimiento":
            $orderby = "c.fecha";
            break;
    }
    
}else{
    
    $orderby = "a.fecha";
    
}

$_SESSION['orderby'] = $orderby;
$_SESSION['order'] = $order;


if(isset($_REQUEST["activa"])){ 
    $_SESSION['activa']=$_REQUEST["activa"];  
}
if(!isset($_SESSION['activa'])){ 
    $_SESSION['activa']='1';
}



$activa = $_SESSION['activa'];

$query_busqueda = " ";

   if(isset($_REQUEST["busqueda"])){
 
    $busqueda=$_REQUEST["busqueda"];
    if($busqueda!=""){
        $query_busqueda = "AND (a.fecha like '%$busqueda%' OR a.operacion like '%$busqueda%' OR b.estado like '%$busqueda%' OR c.comentario like '%$busqueda%' OR c.fecha like '%$busqueda%' OR a.operacion  like '%$busqueda%')";
    }
}

/*
$query_periodo = " ";

if(isset($_REQUEST['fecha_inicial'])&&(isset($_REQUEST['fecha_final']))){
    $fecha_inicial = $_REQUEST['fecha_inicial'];
    $fecha_final = $_REQUEST['fecha_final'];
    
    if(($fecha_inicial!="")&&($fecha_final!="")){
        $query_periodo = "AND a.fecha BETWEEN '$fecha_inicial' AND '$fecha_final' ";
    }
}
*/

/*
$query = "SELECT a.id, a.fecha, a.operacion, b.estado, c.comentario, c.fecha "
        ."FROM operaciones as a "
        ."LEFT JOIN estados B ON a.id_estado=b.id "
        ."LEFT JOIN seguimientos C ON a.id=c.id_operacion AND c.fecha=(SELECT MAX(d.fecha) FROM seguimientos D WHERE a.id=d.id_operacion) "
        ."WHERE a.activa=$activa "
        . $query_busqueda
        ."GROUP BY a.id "
        ."ORDER BY ".$orderby." ".$order;
*/

$query = "SELECT a.id, a.fecha, a.operacion, b.estado, c.comentario, c.fecha "
        ."FROM operaciones as a, estados as b, seguimientos as c "
        ."WHERE a.id_estado=b.id AND c.fecha=(SELECT MAX(c.fecha) FROM seguimientos as c, operaciones as a WHERE a.id=c.id_operacion) "
        ."AND a.activa=$activa " 
        ."GROUP BY a.id "
        ."ORDER BY ".$orderby." ".$order;


/*
$query = "SELECT d.id, a.comunidad, b.provincia, c.municipio, d.direccion, e.tipo, f.tipo, g.vivienda, d.metros_reales, d.metros_computados, d.valor_metros_cuadrados, DATE_FORMAT(d.fecha_tasacion, '%d/%m/%Y') "
        . "FROM comunidades as a, provincias as b, municipios as c, tasaciones as d, tipos_de_via as e, tipos_de_vivienda as f, viviendas as g "
        . "WHERE d.comunidad_id=a.id AND d.provincia_id=b.id AND d.municipio_id=c.id AND d.id_tipo_de_via=e.id AND d.id_tipo_de_vivienda=f.id AND d.id_vivienda=g.id "
        . $query_busqueda
        . $query_periodo
        . "ORDER BY ".$orderby." ".$order;
*/
echo $query;

$result = consulta_sql($query);


if(gettype(mysqli_fetch_array($result2))==NULL){
    
}


$result2 = $result;
//echo "<br>Type -> ".gettype(mysqli_fetch_array($result2));

//echo "<br>Result -> ".count($result2);
//echo "<br>Num Rows -> ". $result;

?>
<div id="title">
<?php
    if ($activa=='1'){
        echo "<h1>Operaciones <text class=activa>Activas</text></h1>";
    }else{
        echo "<h1>Operaciones <text class=inactiva>Inactivas</text></h1>";
    }
?>
</div>
<div id="submenu">
    <a href="page.php?page=form_operaciones.php">+ Nueva operación</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <a href="content.php?activa=1">Activas</a>/<a href="content.php?activa=0">Inactivas</a>
</div>
<div id="buscar">
<h3><i class="fa-solid fa-magnifying-glass"></i> Buscar</h3>
</div>
<div id="form_busqueda">
    <form id="form_buscador" action="content.php" onsubmit="return validar_form(this)">
        <table>
            <tr>
                <td><label><b>Texto</b></label></td>
            </tr>
            <tr>
                <td><label><input type="text" name="busqueda" id="busqueda" placeholder="Introduce palabra de busqueda..."></label></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Buscar"></td>
            </tr>
        </table>
    </form>
    <div id="errores_form"></div>
</div>
<div id="filtros">
    <?php


    if(isset($_REQUEST["busqueda"])){
        if($_REQUEST["busqueda"]!=""){
            echo "<label><i><b>Parámetros de búsqueda:</b></i></label><br>";

            if($_REQUEST["busqueda"]!=""){
                echo "<label><i><b>Texto: </b>".$_REQUEST["busqueda"]."</i></label><br>";
            }
        }
    }

    ?>
</div>


<div id="content2">
    <button onclick="exportTableToExcel('tblData')">Exportar a Excel</button>
    <table class="table table-hover" id="tblData">
        <thead>
            <tr>
                <th scope="col"><a href="content.php?orderby=fecha">Fecha</a></th>
                <th scope="col"><a href="content.php?orderby=operacion">Operacion</a></th>
                <th scope="col"><a href="content.php?orderby=estado">Estado</a></th>
                <th scope="col"><a href="content.php?orderby=comentario">Seguimiento</a></th>
                <th scope="col"><a href="content.php?orderby=ultimo_seguimiento">Última actualización</a></th>
                <th scope="col">Detalles</th>
                
            </tr>
        </thead>
        <tbody>
<?php
    while($datos = mysqli_fetch_array($result)){
        
        echo "<tr>";
        echo "<td>".$datos[1]."</td>";
        echo "<th scope='row'>".$datos[2]."</th>";
        echo "<td>".$datos[3]."</td>";
        echo "<td>".recortar_string($datos[4])."</td>";
        echo "<td>".$datos[5]."</td>";
        echo "<td><a href='page.php?page=detalles_operacion.php&id=".$datos[0]."'><i class='fa-solid fa-bars'></i></a></td>";
        //echo "<td><a href='page.php?page=edit.php&id=".$datos[0]."'>Modificar</a><br><a href='page.php?page=delete.php&id=".$datos[0]."'>Eliminar</a></td>";
        echo "</tr>";
       
    }

?>      
        </tbody>
    </table>
    
</div>
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