<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/lateral.php'; ?>
<div id="contenedor"> 
    <!-- CAJA PRINCIPAL -->
    <div id="principal">
        <h1>Mis Datos</h1>

        <p>Modifica tus datos, cuando quieras!</p><br/>
        
        
    <div id="login" class="bloque">
        <h3>Actualizar Datos</h3>
        
        <!-- MOSTRAR ERRORES -->
        <?php if(isset($_SESSION['completado'])): ?>
        <div class="alerta"> <?=$_SESSION['completado']?></div>
        <?php elseif(isset($_SESSION['errores']['general'])):?>
        <div class="alerta-error"> <?=$_SESSION['errores']['general'];?></div>                
         <?php endif;?>
        
        <form action="actualizar-usuario.php" method="post">
            <label for="nombres">Nombres</label>
            <input type="text" name="nombres" value="<?=$_SESSION['usuario']['nombres']?>">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'nombres') : ' ';?>
            
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" value="<?=$_SESSION['usuario']['apellidos']?>">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'apellidos') : ' ';?>
            
            <label for="email">Email</label>
            <input type="email" name="email" value="<?=$_SESSION['usuario']['email']?>">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'email') : ' ';?>
            
            <input type="submit" name="submit" value="Actualizar">
        </form>
        <?php borrarErrores();?>
    </div>
       


        <?php borrarErrores(); ?>     
    </div><!-- Fin principal -->
    <div class="clearfix"></div>
</div><!-- Fin del contenedor --> 
<?php require_once 'includes/pie.php'; ?>   