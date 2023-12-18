<?php
session_start();

if(isset($_REQUEST['id_comentario'])){
    $_SESSION['id_comentario']=$_REQUEST['id_comentario'];
}else{
    $_SESSION['id_comentario']="";
}

if(isset($_REQUEST['id_nota'])){
    $_SESSION['id_nota']=$_REQUEST['id_nota'];
}else{
    $_SESSION['id_nota']="";
}

if($_REQUEST['id']){
    $_SESSION["id"] = $_REQUEST['id'];
}

if(isset($_REQUEST['page'])){
    $_SESSION["page"] = $_REQUEST['page'];
}else{
    $_SESSION["page"] = 'list.php';
}

header('Location: content.php');

?>