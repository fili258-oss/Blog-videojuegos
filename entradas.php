<?php require_once 'includes/cabecera.php'; ?>

<?php require_once 'includes/lateral.php'; ?>
<div id="contenedor"> 
    <!-- CAJA PRINCIPAL -->
    <div id="principal">
        <h1>Todas las Entradas</h1>
        
        <?php 
        $entradas = conseguirEntradas($db);
        
        if(!empty($entradas) ):
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
        endif;
        
        ?>        
        
    </div><!-- Fin principal -->
    <div class="clearfix"></div>
</div><!-- Fin del contenedor --> 
<?php require_once 'includes/pie.php';?>        

