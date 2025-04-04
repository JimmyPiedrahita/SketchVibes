<div class="container-menu">
    <nav class="menu">
        <a href="index.php"><img src="img/Logo.png" alt="Logo de SketchVibes"></a>
        
        <!--SI el usuario es un administrador mostrar el otro boton que es el de agregar-->
        <input type="search" placeholder="Buscar" id="search-bar" class="search-bar">
        <?php
        if ($_SESSION["administrador"]) {
        ?>
            <a href="agregar.php"><button class="btn btn-action btn-agregar" id="btn-agregar">Agregar</button></a>
        <?php
        }
        ?>
        <form method="post">
            <ul>
                <li><a href="index.php"><button class="btn btn-index" id="btn-salir" name="salir">Cerrar sesión</button></a></li>
            </ul>
        </form>
    </nav>
</div>