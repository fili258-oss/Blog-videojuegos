<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<div id="contenedor"> 
    <!-- CAJA PRINCIPAL -->
    <div id="principal">
        <h1>Crear Categorías</h1>
        <p>Añade nuevas categorías al blog para que los suarios puedas usarlas al crear sus entradas</p><br/>
        <form action="guardar-categoria.php" method="post">
            <label for="id">Nombre Categoría:</label>
            <input type="text" name="nombre">
            
            <input type="submit" name="guardar" value="Guardar">
        </form>
        
        
    </div><!-- Fin principal -->
    <div class="clearfix"></div>
</div><!-- Fin del contenedor --> 
<?php require_once 'includes/pie.php';?>        
        


