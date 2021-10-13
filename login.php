<?php
// INICIAR LA SESIÓN Y LA CONEXIÓN A LA BD
require_once 'includes/conexion.php';
// RECOGER LOS DATOS DEL FORMULARIO
if(isset($_POST)){
        //BORRAR ERROR ANTIGUO
        if(isset($_SESSION['error_login'])){
        unset($_SESSION['error_login']);
       }
    //RECOGER DATOS DEL FORMULARIO
    $email = trim($_POST['email']);
    $password =  $_POST['password'];
}

// CONSULTA PARA VALIDAR LAS  CREDENCIALES DEL USUARIO
$sql = "SELECT * FROM usuarios WHERE email = '$email' ";
$login = mysqli_query($db, $sql);
if($login && mysqli_num_rows($login) == 1){
    $usuario = mysqli_fetch_assoc($login);
    
    //COMPROBAR LA CONTRASEÑA
    $verify =  password_verify($password, $usuario['password']);
    
    if($verify){
        // UTILIZAR UNA SESIÓN PARA GUARDAR LOS DATOS DEL  USUARIO LOGUEADO        
       $_SESSION['usuario'] = $usuario;

    }else{
        //SI ALGO FALLA ENVIAR UNA SESIÓN CON EL FALLO
        $_SESSION['error_login'] = "Login incorrecto";
    }
    
}else{
    //MENSAJE DE ERROR
    $_SESSION['error_login'] = "Login incorrecto";
}  

// REDIRIGIR AL INDEX.PHP
header('Location:index.php');
?>

