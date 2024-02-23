<?php 
include ('..\inc\header.php');
include ('..\inc\container.php');

//Incluye fichero conexion
require_once "..\conexion.php";
require_once "accionPagina.php";

// Variables
$username = $email = $password = $confirm_password = $firstname = $lastname = $lastname2 = $phone = $address = "";
$username_err = $email_err = $password_err = $confirm_password_err = $firstName_err = $lastname_err = $lastname2_err = $phone_err = $address_err ="";
$role = "Cliente";
 
//Procesamiento de datos del formulario cuando se envía 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validar username
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingrese un usuario.";
    }elseif (verificar_datos("[a-zA-Z0-9]{4,20}",($_POST["username"]))) {
            $username_err = "El usuaro ha de tener entre 4 y 20 caracteres. Compuesto por letras seguido de / o números";
    } else{
        // Declaración
        $sql = "SELECT id FROM usuario WHERE username = ?";
        
        if($stmt = mysqli_prepare($db, $sql)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Establecer parámetros
            $param_username = trim($_POST["username"]);
            
            // Ejecutar declaración
            if(mysqli_stmt_execute($stmt)){
                // Resultado
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Este usuario ya existe.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Al parecer algo salió mal.";
            }
        }
         
        // Cerrar consulta
        mysqli_stmt_close($stmt);
    }

    // Validar email
    if(empty(trim(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)))){
        $email_err = "Por favor ingrese un email valido.";
    } else{
        // Declaración
        $sql = "SELECT id FROM usuario WHERE email = ?";
        
        if($stmt = mysqli_prepare($db, $sql)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Establecer parámetros
            $param_email = trim($_POST["email"]);
            
            // Ejecutar declaración
            if(mysqli_stmt_execute($stmt)){
                // Resultado
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "Este email ya existe.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Al parecer algo salió mal.";
            }
        }
         
        // Cerrar consulta
        mysqli_stmt_close($stmt);
    }
    
    // Validar password
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingresa una contraseña.";     
    } elseif(strlen(trim($_POST["password"])) AND verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $_POST['password'])){
        $password_err = "La contraseña al menos debe tener 7 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validar confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirma tu contraseña.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "No coincide la contraseña.";
        }
    }

    //Validar nombre
    if(empty(trim($_POST["firstname"]))){
        $firstName_err = "Por favor introduce tu nombre";
    }elseif (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",($_POST["firstname"]))) {
            $firstName_err = "El nombre ha de tener entre 4 y 20 caracteres compuesto unicamente por letras";
    }else{
        $firstname = trim($_POST["firstname"]);
    }

    //Validar apellido
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Por favor introduce tu primer apellido";
    }elseif (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",($_POST["lastname"]))) {
            $lastname_err = "El apellido ha de tener entre 4 y 20 caracteres compuesto unicamente por letras";
    }else{
        $lastname = trim($_POST["lastname"]);
    }

    //Validar apellido2
    if(empty(trim($_POST["lastname2"]))){
        $lastname2_err = "Por favor introduce tu segundo apellido";
    }elseif (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",($_POST["lastname2"]))) {
        $lastname2_err = "El apellido ha de tener entre 4 y 20 caracteres compuesto unicamente por letras";
    }else{
        $lastname2 = trim($_POST["lastname2"]);
    }

    //Validar teléfono 
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Por favor introduce tu direccion";
    }elseif (verificar_datos("[0-9]{9,11}",($_POST["phone"]))) {
        $phone_err = "El teléfono ha de tener entre 9 u 11 números.";
    }else{
        $phone = trim($_POST["phone"]);
    }

    //Validar dirección 
    if(empty(trim($_POST["address"]))){
        $address_err = "Por favor introduce tu direccion";
    }else{
        $address = trim($_POST["address"]);
    }
    
    // Verificar los errores de entrada antes de insertar en la base de datos
    if(empty($username_err) &&  empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($firstName_err) && empty($lastname_err) && empty($lastname2_err) && empty($phone_err) && empty($address_err)){
        
        // Declaración
        $sql = "INSERT INTO usuario (`username`, `email`, `password`,`role`, `firstname`, `lastname`, `lastname2`, `phone`, `address`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($db, $sql)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_username, $param_email, $param_password, $param_role, $param_firstname, $param_lastname, $param_lastname2, $param_phone, $param_address);
            
            // Establecer parámetros
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Crear un password hash
            $param_role = $role;
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_lastname2 = $lastname2;
            $param_phone = $phone;
            $param_address = $address;
            
        }mysqli_stmt_execute($stmt);

            // Declaración
        $sqlUsers = "INSERT INTO cliente ( `username`, `email`) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($db, $sqlUsers)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "ss",  $param_username, $param_email);
            
            // Establecer parámetros
            $param_username = $username;  
            $param_email = $email;         

            // Ejecutar declaración
            if(mysqli_stmt_execute($stmt)){
                // Redireccionar a la página login
                header("location: login.php");
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
				<h2 class="intro-text text-center">Regristro</h2>
			<hr>
            <div class = "col-md-6">
            <p>Por favor complete el formulario para crear una cuenta</p>           
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control" placeholder="Usuario" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>      
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
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
            <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                <label>Teléfono</label>
                <input type="text" name="phone" class="form-control" placeholder="Teléfono" value="<?php echo $phone;?>">
                <span class="help-block"><?php echo $phone_err?></span>
            </div>
            <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : '';?>">
                <label>Dirección</label>
                <input type="text" name="address" class="form-control" placeholder="Dirección" value="<?php echo $address;?>">
                <span class="help-block"><?php echo $address_err?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Registrar">
                <input type="reset" class="btn btn-default" value="Borrar">
            </div>
            <p>¿Ya tienes una cuenta? <a href="login.php">Ingresa aquí</a>.</p>
        </form>
    </div>
    </div>
</div>
<?php include('..\inc\footer.php')?>
