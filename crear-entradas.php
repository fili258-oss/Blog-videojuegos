<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<div id="contenedor"> 
    <!-- CAJA PRINCIPAL -->
    <div id="principal">
        <h1>Crear Entradas</h1>
        
        <p>Añade nuevas entradas al blog para que los suarios puedan leerlas y disfrutar el contenido</p><br/>
        <form action="guardar-entrada.php" method="post">
            <label for="titulo">Nombre Titulo:</label>
            <input type="text" name="titulo">
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'], 'titulo') : ' ';?>
            
            <label for="descripcion">Descripción de la entrada:</label>
            <textarea name="descripcion"></textarea>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'], 'descripcion') : ' ';?>
            
            
            <label for="categoria">Categoría:</label>
            <select name="categoria">
            <?php
                $categorias = conseguirCategirias($db);
                
                if(!empty($categorias)):
                while ($categoria = mysqli_fetch_assoc($categorias) ) :                                        
             ?>   
                <option value="<?= $categoria['id']?>"><?=$categoria['nombre']?></option>      
             <?php 
            endwhile;
            endif;?>                               
            </select>
<?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'], 'categoria') : ' ';?>
            
            
            
            <input type="submit" name="guardar" value="Guardar">
        </form>
        <?php borrarErrores();?>     
    </div><!-- Fin principal -->
    <div class="clearfix"></div>
</div><!-- Fin del contenedor --> 
<?php require_once 'includes/pie.php';?>        
        




