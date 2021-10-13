<?php
if (isset($_POST)) {
    //CONEXION A LA BASE DE DATOS
    require_once 'includes/conexion.php';

    //RECOGER LOS VALORES DEL FORMULARIO DE ACTUALIZACIÓN Y ESCAPAR CARACTERES EXTRAÑOS
    $nombres = isset($_POST['nombres']) ? mysqli_real_escape_string($db, $_POST['nombres']) : false;
    $apellidos = isset($_POST['apellidos']) ?mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
   

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

    $guardar_usuario = false;
     $usuario = $_SESSION['usuario'];
    if(count($errores) == 0){
        
        //COMPROBAR SI EL EMAILYA EXISTE
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email' ";
        $isset_email = mysqli_query($db, $sql);
       $isset_user = mysqli_fetch_assoc($isset_email);
        if($isset_user['id'] == $usuario['id'] || empty($isset_user)){

            //ACTUALIZAR USUARIO EN LA BASE DE DATOS
             $usuario = $_SESSION['usuario'];
             $sql = "UPDATE usuarios SET nombres = '$nombres', apellidos = '$apellidos', email = '$email' WHERE id = ".$usuario['id'];
             $guardar = mysqli_query($db, $sql);

             if($guardar){
                 $_SESSION['usuario']['nombres'] = $nombres;
                 $_SESSION['usuario']['apellidos'] = $apellidos;
                 $_SESSION['usuario']['email'] = $email;
                 $_SESSION['completado'] = "Tus datos  se han actualizado con éxito";
             }else{
                 $_SESSION['errores']['general'] = "Fallo al actualizar tus datos!";
             }            

        }else {

            $_SESSION['errores']['general'] = "El usuario ya existe!";
        }
       
    }else{
        $_SESSION['errores'] = $errores;
    }
}
        header('Location: mis-datos.php');
        ?>

