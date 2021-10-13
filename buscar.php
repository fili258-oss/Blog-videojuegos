<?php 

if(!isset($_POST['busqueda'])){
    header("Location: index.php");
}

?>



<?php require_once 'includes/cabecera.php'; ?>

<?php require_once 'includes/lateral.php'; ?>
<div id="contenedor"> 
    <!-- CAJA PRINCIPAL -->
    <div id="principal">

                
        <h1>Busqueda: <?=$_POST['busqueda']?></h1>
        
        <?php 
        $entradas = buscarEntradas($db, null, null, $_POST['busqueda'] );
        
        if(!empty($entradas) && mysqli_num_rows($entradas) >=1):
            while($entrada = mysqli_fetch_assoc($entradas)):
         ?>   
        
            <article class="entrada">
         <a href="entrada.php?id=<?=$entrada['id'];?>">       
            <h2><?=$entrada['titulo']?></h2>
            <span class="fecha"><?=$entrada['categoria']. ' | '.$entrada['fecha']?></span>
            <p>
                <!-- Con la función substr cortamos la cadena de la descripción  -->
                <?= substr($entrada['descripcion'], 0, 160)."..." ?>
            </p>
         </a>   
        </article>
        
        <?php
           
        endwhile;
        else:        
        ?>        
        <div class="alerta">No hay entradas en ésta cagegoría</div>
        <?php endif;?>
    </div><!-- Fin principal -->
    <div class="clearfix"></div>
</div><!-- Fin del contenedor --> 
<?php require_once 'includes/pie.php';?>        




