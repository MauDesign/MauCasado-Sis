<?php 
session_start();
require_once 'connect.php';

// validar datos de usuario y si es correcto redireccionarlo a la pagina de dashboard se valida solo datos de incio de sesion correo y passeord
if(isset($_POST["submit"])){
    
    $email = trim($_POST["email"]);
    $password = sha1($_POST["pass"]);

    $sql = "SELECT * FROM users WHERE email = '{$email}' AND pass = '{$password}'";
    $login = mysqli_query($db, $sql);
   
    
    if($login && mysqli_num_rows($login) == 1){
        $_SESSION["logged"] = mysqli_fetch_assoc($login);
        
        if(isset($_SESSION["error_login"])){
            unset($_SESSION["error_login"]);
        }
        header("Location: ../dashboard.php");
    }else{
       $_SESSION["error_login"] = "Usuario o contraseña incorrectos";
       header("Location: ../login.php"); 
    }
    
}
var_dump($_POST);
?>