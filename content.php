<?php
session_start();
if(!isset($_SESSION["page"])){
    $_SESSION["page"] = "login.php";
}
if(!isset($_SESSION['id_usuario'])){
    $_SESSION["page"] = "login.php";
}
/*
echo "Page -> ".$_SESSION["page"]."<br>";
echo "Id_nota -> ".$_SESSION["id_nota"]."<br>";
*/
?>
<?php
/**********************************************************************

Titulo: contenido.php
Autor: Moisés Aguilar Miranda
Fecha: 04/11/2020
Descripción: Página para añadir el contenido.
Comentarios:
 
**********************************************************************/
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Operaciones HG</title>
        <?php
        //if($_SESSION["page"] == "form.php"){echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';}
        //else{echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';}
        ?>
        <meta http-equiv="Content-Type" content="text/html; iso-8859-1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--<meta http-equiv="content-type" content="text/html; utf-8">-->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/fontawesome.js"></script>
        <script src="js/functions.js"></script>
    </head>
    <body>
        <?php
        if($_SESSION["page"]!="login.php"){
            include 'menu.php';
        }   
        ?>
   
        <div id="content">
            <?php
                include $_SESSION["page"];
                //include 'list.php';
            ?>
        </div>
        <footer>
            <p>Habitat Gestions <?php echo date("Y") ?></p>
        </footer>
    </body>
</html>
