<?php 
//Inicializar sesión
session_start();
include '..\inc\header.php';
include '..\inc\container.php';
?>

  <style>
    .container {
      padding: 20px;
    }

    h1 {
      color:red;
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
          <li role="presentation" class="active"><a href="../tienda/index.php">Volver</a></li>
        </ul>
      </div>

      <div class="panel-body">

        <h1>No puede realizar pedidos</h1>
        <p id="mensaje">No se pueden realizar pedidos siendo usuario Administrador. Registrese o inicie sesión como Cliente.</p>
      </div>
      
    </div>

  </div>
  <?php include '..\inc\footer.php' ?>