<?php
		$username = null;
		if(!empty($_SESSION["username"]))
		{
			$username = $_SESSION["username"];
            $role = $_SESSION["role"];
		}
?>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php if($username == null || $username != null){echo '<li><a href="..\tienda\indexAdminS.php">Inicio</a></li>' .
                            '<li><a href="novedades.php?">Lo último</a></li>' .
                            '<li><a href="shop.php?">Tienda</a></li>' .
                            '<li><a href="about.php?">Sobre nosotros</a></li>';}?>
                    <?php if($username != null && $role == "Admin"){echo '<li><a href="userAccount.php?">Tu cuenta</a></li>';} ?>
					<?php if($username == null){echo '<li><a href="registro.php?ActionType=Register">Registrarse</a></li>';} ?>
					<?php if($username == null){echo '<li><a href="login.php?">Iniciar sesión</a></li>';} else {echo '<li><a href="..\logout.php">Cerrar sesión</a></li>';} ?>
                    <!--<li><a href="#" onclick="ManagementOnclick();">Administrador</a></li>-->
                    <!--<li><?php //echo '<strong>' . "Bienvenido ".$username.'</strong>'; ?></li> -->
                    
                    <?php if($username != null && $role == "Admin"){echo '<li><a href="login.php?role=Admin">Administrador</a></li>';}?>
                    <?php //if($username != null){echo '<li><a href="orders.php?role=Admin">Pedidos</a></li>';}?>
                    <?php //if($username != null){echo '<li><a href="products.php?role=Admin">Artículos</a></li>';}?>
                    <?php //if($username != null){echo '<li><a href="productsList.php?role=Admin">Lista de Articulos</a></li>';}?>
                    <?php //if($username != null){echo '<li><a href="clientes.php?role=Admin">Clientes</a></li>';}?>
                    <?php //if($username != null){echo '<li><a href="inventario.php?role=Admin">Inventario</a></li>';}?>
                    <?php //if($username != null){echo '<li><a href="facturas.php?role=Admin">Facturas</a></li>';}?>
					
                </ul>
            </div>
        </div>
    </nav>
</body>