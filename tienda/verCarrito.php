<?php
//Inicializar la clase Carrito
include 'carrito.php';
$cart = new Cart;
?>

<?php 
include('..\inc\header.php');
include('..\inc\container.php');
?>

<style>

    .container {
        padding: 20px;
    }
    input[type="number"] {
        width: 20%;
    }
</style>

<script>
    //Acualizar número de productos carrito
    function updateCartItem(obj, id) {
        $.get("accionCarrito.php", {
            action: "updateCartItem",
            id: id,
            qty: obj.value
        }, function(data) {
            if (data == 'ok') {
                location.reload();
            } else {
                alert('La actualización del carrito falló, por favor intentalo de nuevo.');
            }
        });
    }
</script>

<div class="container">
    <div class="box">
        <div class="col-lg-12"></div>
            <div class="panel panel-default">
                <div class="panel-heading">   
                    <ul class="nav nav-pills nav-sm">
                        <li role="presentation" class="active"><a href="verCarrito.php">Carrito de Compras</a></li>
                        <li role="presentation"><a href="pago.php">Pagar</a></li>
                    </ul>
                </div>
    
                <div class="panel-body">
                    <h1>Carrito de compras</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Color</th>
                                <th>Talla</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Sub total</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($cart->total_items() > 0) {
                                //Obtener items del carrito desde la sesión
                                $cartItems = $cart->contents();
                                foreach ($cartItems as $item) {
                            ?>
                                    <tr>
                                        <td><?php echo $item["name"]; ?></td>
                                        <td><?php echo $item["color"];?></td>
                                        <td><?php echo $item["size"];?></td>
                                        <td><?php echo $item["price"] . '€'; ?></td>
                                        <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
                                        <td><?php echo $item["subtotal"] . '€'; ?></td>
                                        <td>
                                            <a href="accionCarrito.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm(' ¿Deseas eliminar este producto?')"><i class="glyphicon glyphicon-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="5">
                                        <p>No has solicitado ningún producto.....</p>
                                    </td>
                                <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><a href="tienda.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Volver a la tienda</a></td>
                                <td colspan="2"></td>
                                <?php if ($cart->total_items() > 0) { ?>
                                    <td class="text-center"><strong>Total <?php echo  $cart->total() . '€'; ?></strong></td>
                                    <td><a href="pago.php" class="btn btn-success btn-block">Pagos <i class="glyphicon glyphicon-menu-right"></i></a></td>
                                <?php } ?>
                            </tr>
                        </tfoot>
                    </table>    
                </div>                
            </div>        
    </div>
</div>
<?php include '..\inc\footer.php' ?>