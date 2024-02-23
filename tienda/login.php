<?php
// Inicializar la sesión
session_start();
// Incluir archivo de conexión
require_once "..\conexion.php";

include('..\inc\header.php'); 
include ('..\inc\container.php');

// Comprobar si el usuario ya ha iniciado sesión, si es así, redirígirlo a la página principal dependiendo de su rol
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if (isset($_SESSION["adminLogin"])) {
        header("location: ..\admin\adminAccount.php");
        exit;
    }
    if (isset($_SESSION["userLogin"])) {
        header("location: userAccount.php");
        exit;
    } 
  }
   
  // Variable con valores vacíos
  $username = $password = $role = "";
  $username_err = $password_err = $role_err = "";
  $loginMsg = "";
   
  // Procesamiento de datos del formulario cuando se envía el formulario
  if($_SERVER["REQUEST_METHOD"] == "POST"){
   
      // Chequear si el username está vacío
      if(empty(trim($_POST["username"]))){
          $username_err = "Por favor ingrese su usuario.";
      } else{
          $username = trim($_POST["username"]);
      }
      
      // Chequear si el password está vacío
      if(empty(trim($_POST["password"]))){
          $password_err = "Por favor ingrese su contraseña.";
      } else{
          $password = trim($_POST["password"]);
      }

      /*//Chequear si el rol está vacío
      if (empty(trim($_POST["role"]))) {
           $role_err = "Por favor escoja un rol";
      } else {
           $role = trim($_POST["role"]);
      }*/


      
      // Validar credenciales
      if(empty($username_err) && empty($password_err)){
          // Preparar una declaración
          $sql = "SELECT id, username, password, role FROM usuario WHERE username = ?";
          
          if($stmt = mysqli_prepare($db, $sql)){
              // Vincular variables a la declaración preparada como parámetros
              mysqli_stmt_bind_param($stmt, "s", $param_username);
              
              // Establecer parámetros
              $param_username = $username;
              
              // Ejecutar la declaración
              if(mysqli_stmt_execute($stmt)){
                  // Resultado
                  mysqli_stmt_store_result($stmt);
                  
                  // Verificar si existe el nombre de usuario, si es así, verificar la contraseña
                  if(mysqli_stmt_num_rows($stmt) == 1){                    
                      // Vincular variables de resultado
                      mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $role);
                      if(mysqli_stmt_fetch($stmt)){
                          if(password_verify($password, $hashed_password)){
                              // La contraseña es correcta, así que se inicia una nueva sesión
                              //session_start();
                              
                              // Almacenar datos en variables de sesión
                              $_SESSION["loggedin"] = true;
                              $_SESSION["id"] = $id;
                              $_SESSION["username"] = $username;
                              $_SESSION["password"] = $password;
                              $_SESSION["role"] = $role;                            
                              
                              switch ($role) {
                                case 'Administrador':
                                    $_SESSION["adminLogin"] = $username;
                                    $loginMsg = '<div class="alert alert-success" role="alert">
                                    Administrador: Inicio de sesión correcto
                                  </div>';
                                    header("refresh:2;index.php");
                                    break;

                                case 'Cliente':
                                    $_SESSION["userLogin"] = $username;
                                    $loginMsg = '<div class="alert alert-primary" role="alert">
                                    Cliente: Inicio de sesión correcto
                                    </div>';
                                    header("refresh:2;userAccount.php");
                                    break;

                                default:
                                    header("location: login.php");
                                    break;
                              }
                              // Redirect user to welcome page
                              
                          } else{
                              // Display an error message if password is not valid
                              $password_err = "La contraseña que has ingresado no es válida.";
                          }
                      }
                  } else{
                      // Display an error message if username doesn't exist
                      $username_err = "No existe cuenta registrada con ese nombre de usuario.";
                  }
              } else{
                  echo "Algo salió mal, por favor vuelve a intentarlo.";
              }
          }
          
          // Close statement
          mysqli_stmt_close($stmt);
      }
      
      // Close connection
      mysqli_close($db);
  }
?>

<?php include('..\inc\menu.php');?>
<div class="container">
    <div class="box">
        <div class="col-lg-12"></div>
            <hr>
				<h2 class="intro-text text-center">Inicio de sesión</h2>
			<hr>
            <div class="col-md-6">
            <?php echo $loginMsg?>
            <p>Por vavor introduce tu usuario y contraseña</p>            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <!--<div class="form-group <?php echo (!empty($role_err)) ? 'has-error' : ''; ?>">
                <label>Tipo de usuario</label>
                <select class="form-control" name="role">
                    <option value="" selected="selected" >- Seleciona un rol -</option>
                    <option value="Admin">Administrador</option>
                    <option value="User">Usuario</option>
                </select>
                <span class="help-block"><?//php echo $role_err; ?></span>
            </div>-->
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Ingresar">
                <input type="reset" class="btn btn-default" value="Borrar">
            </div>
            <p>¿No tienes una cuenta? <a href="registro.php">Regístrate ahora</a>.</p>
        </form>
            </div>
    </div>
</div>
<?php include('..\inc\footer.php')?>