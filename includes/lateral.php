
<!-- BARRA LATERAL-->
<aside id="sidebar">
    <!-- BUSCADOR-->
    <div id="buscador" class="bloque">
        <h3>Buscar</h3>

        <form action="buscar.php" method="post">

            <input type="text" name="busqueda">

            <input type="submit" value="Buscar">
        </form>
    </div>





    <?php if (isset($_SESSION['usuario'])) : ?>
        <div id="usuario-logueado" class="bloque">
            <h3>Bienvenido, <?= $_SESSION['usuario']['nombres']; ?></h3>
            <!-- Botones -->

            <a href="crear-entradas.php" class="boton boton-verde">Crear entradas</a>
            <a href="crear-categoria.php" class="boton">Crear categoría</a>
            <a href="mis-datos.php" class="boton boton-naranja">Mis datos</a>
            <a href="cerrar.php" class="boton boton-rojo">Cerrar Sesión</a>     
        </div>  
    <?php endif; ?>

    <!-- OCULTAR PANELES UNA VEZ LOGUEADO EL USUARIO -->
    <?php if (!isset($_SESSION['usuario'])) : ?>
        <div id="login" class="bloque">
            <h3>Identificate</h3>

            <?php if (isset($_SESSION['error_login'])) : ?>
                <div class="alerta-error">
                    <?= $_SESSION['error_login'] ?>
                </div>  
            <?php endif; ?>

            <form action="login.php" method="post">
                <label for="email">Email</label>
                <input type="email" name="email">

                <label for="password">Contraseña</label>
                <input type="password" name="password">

                <input type="submit" name="entrar" value="Ingresar">
            </form>
        </div>

        <div id="login" class="bloque">
            <h3>Regístrate</h3>

            <!-- MOSTRAR ERRORES -->
            <?php if (isset($_SESSION['completado'])): ?>
                <div class="alerta"> <?= $_SESSION['completado'] ?></div>
            <?php elseif (isset($_SESSION['errores']['general'])): ?>
                <div class="alerta-error"> <?= $_SESSION['errores']['general']; ?></div>                
            <?php endif; ?>

            <form action="registro.php" method="post">
                <label for="nombres">Nombres</label>
                <input type="text" name="nombres">
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'nombres') : ' '; ?>

                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos">
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'apellidos') : ' '; ?>

                <label for="email">Email</label>
                <input type="email" name="email">
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'email') : ' '; ?>

                <label for="password">Contraseña</label>
                <input type="password" name="password">
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'password') : ' '; ?>            


                <input type="submit" name="submit" value="Registrarme">
            </form>
            <?php borrarErrores(); ?>
        </div>
    <?php endif; ?>
</aside>


