<?php  
//Inicializar sesión
session_start();
include('..\inc\header.php');
include('..\inc\container.php');
?>
<?php 
// Verificar si el usuario ha iniciado sesión, si no, redirígirlo a la página de inicio de sesión
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
//Si la sesión es iniciada con un rol diferente al de usuario redirigir al usuario a la págin que le corresponde
}elseif ($_SESSION["role"] !="Cliente"){
    header("location: ..\admin\adminAccount.php");
    exit;
}

//Incluye fichero conexion
require_once "..\conexion.php";

// Variables
$password = $confirm_password = $firstname = $lastname = $lastname2 = $phone = $address = "";
$password_err = $confirm_password_err = $firstName_err = $lastname_err = $lastname2_err = $phone_err = $address_err ="";

//Declaración formulando una consulta
$sql = "SELECT * FROM usuario WHERE id = '". $_SESSION["id"] ."'";
$resultado = mysqli_query($db,$sql);
//Guardar resultado como objetos
while ($fila = mysqli_fetch_object($resultado)) {

	$firstname = $fila -> firstname;
	$lastname = $fila -> lastname;
	$lastname2 = $fila -> lastname2;
    $phone = $fila -> phone;
	$address = $fila -> address;
}
 
//Procesamiento de datos del formulario cuando se envía el formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){
     
    // Validar password
    if(empty(trim($_POST["password"]))){
        $password = trim($_POST["password"]);    
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "La contraseña al menos debe tener 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validar confirm password
    if(empty(trim($_POST["password"]))){
        $password = trim($_POST["password"]);        
    } elseif(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirma tu contraseña.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Las contraseña no coincide .";
        }
    }

    //Validar nombre
    if(empty(trim($_POST["firstname"]))){
        $firstName_err = "Por favor introduce tu nombre";
    }else{
        $firstname = trim($_POST["firstname"]);
    }

    //Validar apellido
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Por favor introduce tu primer apellido";
    }else{
        $lastname = trim($_POST["lastname"]);
    }

    //Validar apellido2
    if(empty(trim($_POST["lastname2"]))){
        $lastname2_err = "Por favor introduce tu segundo apellido";
    }else{
        $lastname2 = trim($_POST["lastname2"]);
    }

    //Validar teléfono
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Por favor introduce tu segundo apellido";
    }else{
        $phone = trim($_POST["phone"]);
    }

    //Validar dirección 
    if(empty(trim($_POST["address"]))){
        $address_err = "Por favo introduce tu direccion";
    }else{
        $address = trim($_POST["address"]);
    }
    
    // Verificar los errores de entrada antes de insertar en la base de datos
    if(empty($password_err) && empty($confirm_password_err) && empty($firstName_err) && empty($lastname_err) && empty($lastname2_err) && empty($phone_err) && empty($address_err)){
        
        // Declaración
        $sql = "UPDATE  usuario SET password = ? ,firstname = ?,lastname = ?,lastname2 = ?,phone = ?,address = ? WHERE id = ?";
         
        if($stmt = mysqli_prepare($db, $sql)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "ssssssi", $param_password, $param_firstname, $param_lastname, $param_lastname2, $param_phone , $param_address ,$param_id);
            
            // Establecer parámetros
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_lastname2 = $lastname2;
            $param_phone = $phone;
            $param_address = $address;
            $param_id = $_SESSION["id"];
            
            // Ejecutar declaración
            if(mysqli_stmt_execute($stmt)){
                // Redireccionar a la página login
                header("location: userAccount.php");
                exit;
            } else{
                echo "Algo salió mal, por favor inténtalo de nuevo.";
            }
        }
         
        // Cerrar declaración
        mysqli_stmt_close($stmt);
    }
    
    // Cerrar conexión
    mysqli_close($db);
}

?>
<?php include('..\inc\menu.php');?>
<div class = "container">
    <div class = "row">
        <div class = "box">
        <div class="col-lg-12"></div>
            <hr>
				<h2 class="intro-text text-center">Edita la información de tu cuenta</h2>
			<hr>
            <div class = "col-md-6">           
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">      
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label class="text-primary">SI desea actualizar la contraseña de este usuario por favor llene los 2 campos.Si NO desea actualizar la contraseña deje los campos vacíos.</label>
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="Contraseña" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirmar Contraseña</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirmar contraseña" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($firstName_err)) ? 'has-error' : ''; ?>">
                <label>Nombre</label>
                <input type="text" name="firstname" class="form-control" placeholder="Nombre" value="<?php echo $firstname;?>">
                <span class="help-block"><?php echo $firstName_err?></span>
            </div>
            <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                <label>Apellido</label>
                <input type="text" name="lastname" class="form-control" placeholder="Apellido" value="<?php echo $lastname;?>">
                <span class="help-block"><?php echo $lastname_err?></span>
            </div>
            <div class="form-group <?php echo (!empty($lastname2_err)) ? 'has-error' : ''; ?>">
                <label>Segundo apellido</label>
                <input type="text" name="lastname2" class="form-control" placeholder="Segundo apellido" value="<?php echo $lastname2;?>">
                <span class="help-block"><?php echo $lastname2_err?></span>
            </div>
            <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : '';?>">
                <label>Teléfono</label>
                <input type="text" name="phone" class="form-control" placeholder="Teléfono" value="<?php echo $phone;?>">
                <span class="help-block"><?php echo $phone_err?></span>
            <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : '';?>">
                <label>Dirección</label>
                <input type="text" name="address" class="form-control" placeholder="Dirección" value="<?php echo $address;?>">
                <span class="help-block"><?php echo $address_err?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Enviar">
                <input type="reset" class="btn btn-default" value="Borrar">
                <a class="btn btn-link" href="userAccount.php">Cancelar</a>
            </div>
        </form>
    </div>
    </div>
</div>

<?php include('..\inc\footer.php')?>


