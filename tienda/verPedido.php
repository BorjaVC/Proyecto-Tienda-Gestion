<?php 
session_start();
include "..\inc\header.php";
include "..\inc\container.php";
//Conexión BD
require "..\conexion.php";
?>

<?php 
//Verificar si el usuario a iniciado sesión ,si no redirigirlo a la página de inicio de sesión
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
//Si la sesión es iniciada con un rol diferente al de usuario redirigir al usuario a la págin que le corresponde
}elseif ($_SESSION['role'] != "Cliente") {
    header("location: ..\admin\adminAccount.php");
    exit;
}
$ordenAccion = "Ver";

$ordenID = $_GET['ordenID'];
?>

<?php include('..\inc\menu.php');?>
<div class="container">
    <div class="box">
        <div class="col-lg-12">
            <hr>
                <h2 class="intro-text text-center">Detalle del Pedido </h2>
            <hr>      
            <div class="col-md-6">	
				<h4 style="text-align: center">Pedido Nº <?php echo $ordenID ?></h4>
				<div class="table-responsive">
					<table border="5px" class="table">
						<tr style="text-align: center; color: Black; font-weight: bold;">
							<td>Artículo</td>
							<td>Talla</td>
							<td>Color</td>
							<td>Cantidad</td>
						</tr>
						
						<?php 
						$sql = "SELECT * FROM productos_pedido WHERE order_id = " . $ordenID;
						$Resulta = mysqli_query($db,$sql);
						while($Rows = mysqli_fetch_array($Resulta)):; 
						?>
						<tr class="has-text-centered" >
						<td><?php echo $Rows[3]; ?></td>
						<td><?php echo $Rows[4]; ?></td>
						<td><?php echo $Rows[5]; ?></td>
			            <td><?php echo $Rows[6];?></td>
						<?php endwhile; ?>
						</tr>
					</table>
					<td><a href="userAccount.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Volver a tu cuenta</a></td>
				</div>
            </div>
        </div>
    </div>
</div>
<?php include('..\inc\footer.php')?>