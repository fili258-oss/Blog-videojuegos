<?php require_once 'includes/helpers.php'; ?>
<?php require_once 'includes/conexion.php'; ?>
<?php 

$entrada_actual = conseguirEntrada($db, $_GET['id']);
if(!isset($entrada_actual['id'])){
    header("Location: index.php");
}
?>

<?php require_once 'includes/cabecera.php'; ?>

<?php require_once 'includes/lateral.php'; ?>
<div id="contenedor"> 
    <!-- CAJA PRINCIPAL -->
    <div id="principal">
        <h1>Editar Entradas</h1>
        
        <p>Edita tu entrada <?=$entrada_actual['titulo']?></p><br/>
        <form action="guardar-entrada.php?editar=<?=$entrada_actual['id']?>" method="post">
            <label for="titulo">Nombre Titulo:</label>
            <input type="text" name="titulo" value="<?=$entrada_actual['titulo']?>">
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'], 'titulo') : ' ';?>
            
            <label for="descripcion">Descripción de la entrada:</label>
            <textarea name="descripcion"><?=$entrada_actual['descripcion']?></textarea>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'], 'descripcion') : ' ';?>
            
            
            <label for="categoria">Categoría:</label>
            <select name="categoria">
            <?php
                $categorias = conseguirCategirias($db);
                
                if(!empty($categorias)):
                while ($categoria = mysqli_fetch_assoc($categorias) ) :                                        
             ?>                                                                 <!--RELLENAR EL SELECT PARA EDITAR UNA ENTRADA -->      
                <option value="<?= $categoria['id']?>" <?=($categoria['id'] == $entrada_actual['categoria_id']) ? 'selected="selected" ' : ' '?>>                                 
                <?=$categoria['nombre']?>    
                </option>      
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

