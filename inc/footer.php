<?php
//Si un usuario ha inicializado sesión guardar sus datos en variables de sesión
		$username = null;
		if(!empty($_SESSION["username"]))
		{
			$username = $_SESSION["username"];
            $role = $_SESSION["role"];
		}
?>
<footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>
					<?php echo '<strong>'.$username.'</strong>'; ?>
					<br>
					<strong>
					<?php 
					if($username != null && $role == "Cliente"){
						echo '<a href="userAccount.php">Tu cuenta |</a> ';
					} else if($username != null && $role == "Administrador"){
						echo '<a heref="admin.aAccount.php">Perfil aministrador</a> |';}?> 
					<?php if($username == null){echo '<a href="login.php?">Iniciar sesión |</a>';} else {echo '<a href="..\logout.php">Logout |</a>';} ?>  
					<?php if ($username != null && $role == "Cliente") {
						echo '<a href="index.php">Inicio</a>';
					}else if ($username != null && $role == "Administrador") {
						echo '<a href="../tienda/index.php">Inicio</a>';
					} else{
						echo '<a href="index.php">Inicio</a>';
					}
					 ?>
					</strong><br>
					Copyright &copy; Borja Vidal Cormenzana
					</p>
					
                </div>
            </div>
        </div>
</footer>