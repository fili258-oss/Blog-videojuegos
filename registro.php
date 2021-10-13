<?php

if (isset($_POST)) {
    //CONEXION A LA BASE DE DATOS
    require_once 'includes/conexion.php';

    //INICIAR SESIÓN
    if(!isset($_SESSION)){
    session_start();
    }
    //RECOGER LOS VALORES DEL FORMULARIO DE REGISTRO Y ESCAPAR CARACTERES EXTRAÑOS
    $nombres = isset($_POST['nombres']) ? mysqli_real_escape_string($db, $_POST['nombres']) : false;
    $apellidos = isset($_POST['apellidos']) ?mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

    //ARRAY DE ERRORES
    $errores = array();

    //VALIDAR LOS DATOAS ANTES DE GUARDARLOS EN LA BASE DE DATOS
    
    // VALIDAR LOS NOMBRES
    if (!empty($nombres) && !is_numeric($nombres) && !preg_match("/[0-9]/", $nombres)) {
        $nombres_validados = true;
    } else {
        $nombres_validados = false;
        $errores ['nombres'] = "El nombre no es válido";
    }

    // VALIDAR LOS APELLIDOS
    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
        $apellidos_validados = true;
    } else {
        $apellidos_validados = false;
        $errores ['apellidos'] = "Los apellidos no son correctos";
    }

    // VALIDAR EL EMAIL
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validado = true;
    } else {
        $email_validado = false;
        $errores ['email'] = "El email no es valido";
    }

    // VALIDAR LA CONTRASEÑA
    if (!empty($password)) {
        $password_validado = true;
    } else {
        $password_validado = false;
        $errores ['password'] = "La contraseña está vacía";
    }
    
    $guardar_usuario = false;
    if(count($errores) == 0){
         $guardar_usuario = true;
         
         //CIFRAR LA CONTRASEÑA
         $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' =>4]);
 
        //INSERTAR USUARIO EN LA BASE DE DATOS
         $sql = "INSERT INTO usuarios VALUES(null, '$nombres', '$apellidos', '$email', '$password_segura', CURDATE())";
         $guardar = mysqli_query($db, $sql);

         if($guardar){
             $_SESSION['completado'] = "El registro se ha completado con éxito";
         }else{
             $_SESSION['completado']['general'] = "Fallo al guardar el usuario!";
         }
       
    }else{
        $_SESSION['errores'] = $errores;
    }
}
        header('Location: index.php');
        

?>