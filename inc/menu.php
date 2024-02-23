<style>
.cart-link {
            width: 100%;
            text-align: right;
            display: block;
            font-size: 22px;
        }
</style>
<?php
//Si un usuario ha inicializado sesión guardar sus datos en variables de sesión
		$username = null;
		if(!empty($_SESSION["username"]))
		{
			$username = $_SESSION["username"];
            $role = $_SESSION["role"];
            $id = $_SESSION["id"];
		}
?>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php if($username != null && $role == "Cliente"){echo '<li><a href="index.php">Inicio</a></li>' .
                            '<li><a href="novedades.php?">Lo último</a></li>' .
                            '<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="tienda.php?" role="button" aria-expanded="false">Tienda</a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="tienda3.php?vista=ring&page=">Anillos</a></li>
                              <li><a class="dropdown-item" href="tienda3.php?vista=necklace&page=">Collares</a></li>
                              <li><a class="dropdown-item" href="tienda3.php?vista=earrings&page=">Pendientes</a></li>
                              <li><a class="dropdown-item" href="tienda3.php?vista=bracelet&page=">Pulseras</a></li>
                            </ul>
                          </li>' ;
                            }else if($username != null  && $role == "Administrador"){echo '<li><a href="..\tienda\index.php">Inicio</a></li>' .
                            '<li><a href="..\tienda\novedades.php?">Lo último</a></li>' .
                            '<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="tienda.php?" role="button" aria-expanded="false">Tienda</a>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="tienda3.php?vista=ring&page=">Anillos</a></li>
                            <li><a class="dropdown-item" href="tienda3.php?vista=necklace&page=">Collares</a></li>
                            <li><a class="dropdown-item" href="tienda3.php?vista=earrings&page=">Pendientes</a></li>
                            <li><a class="dropdown-item" href="tienda3.php?vista=bracelet&page=">Pulseras</a></li>
                            </ul>
                          </li>';
                            } else {
                                echo '<li><a href="..\tienda\index.php">Inicio</a></li>' .
                            '<li><a href="..\tienda\novedades.php?">Lo último</a></li>' .
                            '<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="tienda.php?" role="button" aria-expanded="false">Tienda</a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="tienda3.php?vista=ring&page=">Anillos</a></li>
                              <li><a class="dropdown-item" href="tienda3.php?vista=necklace&page=">Collares</a></li>
                              <li><a class="dropdown-item" href="tienda3.php?vista=earrings&page=">Pendientes</a></li>
                              <li><a class="dropdown-item" href="tienda3.php?vista=bracelet&page=">Pulseras</a></li>
                            </ul>
                          </li>' ;
                            }?>
                      
                    <?php if($username != null && $role == "Cliente" ){echo '<li><a href="userAccount.php?">Tu cuenta</a></li>';} ?>
                    <?php if($username != null && $role == "Administrador"){echo '<li><a href="..\gestion\index.php">Perfil administrador</a></li>';} ?>                                        
                    <?php // if($username != null && $role == "Administrador"){echo '<li><a href="facturas.php?">Facturas</a></li>';}?>
                    <?php if($username == null){echo '<li><a href="login.php?">Iniciar sesión</a></li>';}else {echo '<li><a href="..\logout.php">Cerrar sesión</a></li>';} ?>               					
                    <?php if($username == null){echo '<li><a href="registro.php?ActionType=Register">Registrarse</a></li>';} ?>
					<?php if($username == null || $role == "Cliente" ){echo '<li><a href="verCarrito.php" class="cart-link" title="Ver Carrito"><i class="glyphicon glyphicon-shopping-cart"></i></a></li>';}?>


                    <!--<li><a href="#" onclick="ManagementOk();">Administrador</a></li>-->
                    <!--<li><?php //echo '<strong>' . "Bienv ".$username.'</strong>'; ?></li> -->
                </ul>
</div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>