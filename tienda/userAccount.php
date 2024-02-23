<?php 
//Inicializar sesión 
session_start();
include('..\inc\header.php');
include('..\inc\container.php');
?>

<?php 
// Verificar si el usuario ha iniciado sesión, si no, redirígirlo a la página de inicio de sesión
if (!isset($_SESSION["loggedin"])|| $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
//Si la sesión es iniciada con un rol diferente al de usuario redirigir al usuario a la págin que le corresponde
}elseif ($_SESSION["role"] !="Cliente"){
    header("location: ..\admin\adminAccount.php");
    exit;
}

//Incluir archivo de conexión
require '..\conexion.php';

//Si un usuario ha inicializado sesión guardar sus datos en variables de sesión
$username = null;
if (!empty($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $password = $_SESSION["password"] ;
    $id = $_SESSION["id"];
}

//Variables datos cliente
$c_id = $c_username =  $c_email = $c_password = $c_created = $c_role = $c_firstname = $c_firstname = $c_lastname = $c_lastname = $c_lastname2 =$c_phone = $c_address ="";
//Declaración formulando una consulta
$sql = "SELECT * FROM usuario WHERE id = '". $id ."'";
$resultado = mysqli_query($db,$sql);
//Guardar resultado como objetos
while ($fila = mysqli_fetch_object($resultado)) {
    $c_username = $fila -> username;
    $c_email = $fila -> email;
	$c_password = $fila -> password;
	$c_firstname = $fila -> firstname;
	$c_lastname = $fila -> lastname;
	$c_lastname2 = $fila -> lastname2;
    $c_phone = $fila -> phone;
	$c_address = $fila -> address;
}
//Guardar resultado tras iteración en un array
/*while ($fila = mysqli_fetch_array($resultado)) {

    $c_id = $fila[0];
    $c_username = $fila[1];
    $c_email = $fila[2];
    $c_password = $fila[3];
    $c_created = $fila[4];
    $c_role = $fila[5];
    $c_firstname = $fila[6];
    $c_lastname = $fila[7];
    $c_lastname2 = $fila[8];
    $c_phone = $fila[9];
    $c_address = $fila[10];
}*/
?>

<?php include('..\inc\menu.php');?>
<div class="container">
    <div class="box">
        <div class="col-lg-12">
            <hr>
                <h2 class="intro-text text-center">Perfil de usuario</h2>
            <hr>
            <div class="col-md-6" >
                <form role= "form "action="ActionType=Edit&Loc=MA&ID=<?php echo $c_id;?>" method="POST">
                    <h4 style="text-align: center">Información de la cuenta</h4>
                    <div class="form-group">
					  <label for="username">Usuario:</label>
					  <input type="text" name="username" class="form-control" id="username" value="<?php echo $c_username; ?>" disabled>
					</div>
                    <div class="form-group">
					  <label for="email">Email:</label>
					  <input type="text" name="email" class="form-control" id="email" value="<?php echo $c_email; ?>" disabled>
					</div>
                    <div class="form-group">
					  <label for="password">Contraseña:</label>
					  <input type="password" name="password" class="form-control" id="password" value="<?php echo $c_password; ?>" disabled>
					</div>
                    <div class="form-group">
					  <label for="firstname">Nombre:</label>
					  <input type="text" name="firstname" class="form-control" id="firstname" value="<?php echo $c_firstname; ?>" disabled>
					</div>
                    <div class="form-group">
					  <label for="lastname">Apellido:</label>
					  <input type="text" name="lastname" class="form-control" id="lastname" value="<?php echo $c_lastname; ?>" disabled>
					</div>
                    <div class="form-group">
					  <label for="lastname2">Segundo apellido:</label>
					  <input type="text" name="lastname2" class="form-control" id="lastname2" value="<?php echo $c_lastname2; ?>" disabled>
					</div>
                    <div class="form-group">
					  <label for="phone">Teléfono:</label>
					  <input type="text" name="phone" class="form-control" id="phone" value="<?php echo $c_phone; ?>" disabled>
					</div>
                    <div class="form-group">
					  <label for="address">Dirección:</label>
					  <input type="text" name="address" class="form-control" id="address" value="<?php echo $c_address; ?>" disabled>
					</div>
                    <a href="editInfo.php" class="btn btn-success">Edita tu información</a>                        
                </form>
            </div> 
                  
            <div class="col-md-6">	
				<h4 style="text-align: center">Mis Pedidos</h4>
				<div class="table-responsive">
					<table border="5px" class="table">
						<tr style="text-align: center; color: Black; font-weight: bold;">
							<td>Número de orden</td>
							<td>Importe</td>
							<td>Fecha de la Orden</td>
							<td>Estado</td>
							<td colspan="2">Opciones</td>
						</tr>
						
						<?php 
						$sqlI = "SELECT * FROM pedido WHERE CUSTOMER_ID = " . $id;
						$resultado = mysqli_query($db,$sqlI);
						while($row = mysqli_fetch_array($resultado)):; 
						?>
						<tr style="text-align: center; color: Black;">
						<td><?php echo $row[0]; ?></td>
						<td><?php echo $row[2] . ' € '; ?></td>
						<td><?php echo $row[4]; ?></td>
						<td><?php echo $row[6]; ?></td>
			            <td>
						    <a href="#" onclick="ordenOnclick('Ver',<?php echo $row[0]; ?>);"class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i></a>
						</td>
						<td>
						    <a href="#" onclick="ordenOnclick('Cancelar',<?php echo $row[0]; ?>);" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
						</td>
						<?php endwhile; ?>
						</tr>
					</table>
				</div>
            </div>
        </div>
    </div>
</div>
<?php include('..\inc\footer.php')?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
		function ordenOnclick(action,oID)
		{
			if (action == "Ver") {
				if (confirm("¿Deseas ver tu pedido?" + " Nº de Orden " + oID)) {
					window.open("verPedido.php?ordenID="+oID+"&ordenAccion="+action,"_self",null,true);
				}
			}else if (action == "Cancelar") {
				if (confirm("¿Estas seguro de cancelar este pedido?" + " Nº de Orden " + oID)) {
					window.open("accionPedido.php?ordenID="+oID+"&ordenAccion="+action,"_self",null,true)
				}
			}
		}
	</script>