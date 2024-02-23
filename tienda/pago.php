<?php 
//Incluye conexión a BD
include '..\conexion.php';

// Inicializar  clase del carrito de compras
include 'carrito.php';
$cart = new Cart;

include('..\inc\header.php');
include('..\inc\container.php');

/*if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Variable método de pago 
    $payment_method = "";
    $param_payment_method = $_POST['exampleRadios'];
    
    //Declaración 
    $sql = "INSERT INTO pedido (`payment_method`) VALUES (?) ";
    
    if($stmt = mysqli_prepare($db, $sql)){
        // Vincular variables a la declaración preparada como parámetros
        mysqli_stmt_bind_param($stmt, "s", $param_payment_method);
        
        // Establecer parámetros
        $param_payment_method;
        
    }mysqli_stmt_execute($stmt);
    
     // Ejecutar declaración
     if(mysqli_stmt_execute($stmt)){
        // Redireccionar a la página login
        header("location: verpedido.php");
    } else{
        echo "Algo salió mal, por favor inténtalo de nuevo.";
    }// Cerrar declaración
    mysqli_stmt_close($stmt);
    }*/

// Redireeciona si el carrito está vacío
if ($cart->total_items() <= 0) {
    header("Location: index.php");
}

// Establecer id del cliente en la sesión
$_SESSION['sessCustomerID'] = $_SESSION['id'];

// Obtener datos del cliente por ID de cliente de sesión
$query = $db->query("SELECT * FROM usuario WHERE id = " . $_SESSION['sessCustomerID']);
$custRow = $query->fetch_assoc();
?>

    <style>
        .container {
            padding: 20px;
        }

        .table {
            width: 65%;
            float: left;
        }

        .shipAddr {
            width: 30%;
            float: left;
            margin-left: 30px;
        }

        .footBtn {
            width: 95%;
            float: left;
        }

        .orderBtn {
            float: right;
        }
    </style>

<div class="container">
    <div class="box">
        <div class="col-lg-12"></div>    
        <div class="panel panel-default">
            <div class="panel-heading">   
                <ul class="nav nav-pills" ><link rel="stylesheet">
                    <li role="presentation"><a href="verCarrito.php">Carrito de Compras</a></li>
                    <li role="presentation" class="active"><a href="pago.php">Pagar</a></li>
                </ul>
            </div>

            <div class="panel-body">
                <h1>Vista previa del pedido</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Sub total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($cart->total_items() > 0) {
                            //Obtener artículos del carrito del cliente
                            $cartItems = $cart->contents();
                            foreach ($cartItems as $item) {
                        ?>
                                <tr>
                                    <td><?php echo $item["name"]; ?></td>
                                    <td><?php echo $item["price"] . '€'; ?></td>
                                    <td><?php echo $item["qty"]; ?></td>
                                    <td><?php echo $item["subtotal"] . '€'; ?></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="4">
                                    <p>No hay articulos en tu carrito......</p>
                                </td>
                            <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <?php if ($cart->total_items() > 0) { ?>
                                <td class="text-center"><strong> Total <?php echo $cart->total() . '€'; ?></strong></td>
                            <?php } ?>
                        </tr>
                    </tfoot>
                    <form action="accionCarrito.php?action=placeOrder" method="post">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="payment_method1" value="Tajeta" checked>
                    <label class="form-check-label" for="payment_method1">
                      Tarjeta
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="payment_method2" value="Contra-Rembolso">
                    <label class="form-check-label" for="payment_method2">
                      Contra-Rembolso
                    </label>
                </div>
                </form>
                </table>
                <div class="shipAddr">
                    <h4>Detalles de envío</h4>
                    <p><?php echo $custRow['firstname']; ?></p>
                    <p><?php echo $custRow['lastname'] . ' '. $custRow['lastname2'] ?></p>
                    <p><?php echo $custRow['email']; ?></p>
                    <p><?php echo $custRow['phone']; ?></p>
                    <p><?php echo $custRow['address']; ?></p>
                </div>
               
                
                <div class="footBtn">
                    <a href="tienda.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Comprando</a>
                    <a href="accionCarrito.php?action=placeOrder" input type ="submit" class="btn btn-success orderBtn">Realizar pedido <i class="glyphicon glyphicon-menu-right"></i></a>
                </div>
            </div>           
        </div>
    </div>
</div>
<?php include '..\inc\footer.php' ?>
    
