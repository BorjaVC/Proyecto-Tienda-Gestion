<?php
session_start();
if (!isset($_REQUEST['id'])) {
  header("Location: index.php");
}
// Verificar si el usuario ha iniciado sesión, si no, redirígirlo a la página de inicio de sesión
if (!isset($_SESSION["loggedin"])|| $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
//Si la sesión es iniciada con un rol diferente al de usuario redirigir al usuario a la págin que le corresponde
}elseif ($_SESSION["role"] !="Cliente"){
  header("location: ..\admin\adminAccount.php");
  exit;
}
?>

<?php 
include '..\inc\header.php';
include '..\inc\container.php';
?>

  <style>
    .container {
      padding: 20px;
    }

    #mensaje {
      color: #34a853;
      font-size: 18px;
    }
  </style>

  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">
        <ul class="nav nav-pills">
          <li role="presentation" class="active"><a href="tienda.php">Volver</a></li>
        </ul>
      </div>

      <div class="panel-body">

        <h1>Estado de tu Pedido</h1>
        <p id="mensaje">La Orden se ha enviado exitósamente. El ID de tu pedido es <?php echo $_GET['id']; ?></p>
      </div>
      
    </div>

  </div>
  <?php include '..\inc\footer.php' ?>