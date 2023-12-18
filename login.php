<?php

/**********************************************************************

Titulo: login.php
Autor: Moisés Aguilar Miranda
Fecha: 04/10/2022
Descripción: Página de login.
Comentarios:

https://code.tutsplus.com/es/tutorials/create-a-php-login-form--cms-33261
 
**********************************************************************/

?>
<?php
include 'functions/connect_db.php';
include 'functions/functions.php';

?>
<?php
 
if (isset($_POST['login'])) {
 
    $username = $_POST['usuario'];
    $password = $_POST['password'];
    
    //echo "username ->".$username."<br>";
    //echo "password ->".$password."<br>";
 
    $query = "SELECT * FROM usuarios WHERE usuario='".$username."' AND password='".md5($password)."'";

    //echo $query;    
    
    $res = convertir_res_mysql_en_array(consulta_sql($query));
 
    if (!$res) {
        echo '<p class="error">Username password combination is wrong!</p>';
    } else {
        $_SESSION['id_usuario'] = $res['id'];
        //echo '<p class="success">Congratulations, you are logged in!</p>';
        $_SESSION['page']='list.php';
        header('Location: content.php');
        
        
    }
}


?>
<div id="title">
    
    
</div>

<div id="content2">
    <div id="login">
        <h2>Login</h2>
        <form method="post" action="" name="signup-form">
            <table id="tabla_login">
                <tr>
                    <td><label>Usuario</label></td>
                    <td><input type="text" id="usuario" name="usuario" pattern="[a-zA-Z0-9]+" required /></td>
                </tr>
                <tr>
                    <td><label>Password</label></td>
                    <td><input type="password" id="password" name="password" required /></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit" name="login" value="login">Login</button></td>
                </tr>
            </table>
            
            
        </form>

    </div>
</div>
