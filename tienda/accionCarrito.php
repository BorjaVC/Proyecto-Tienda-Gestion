<?php
date_default_timezone_set("europe/madrid");
// Iniciamos la clase de la carta
include 'carrito.php';
$cart = new Cart;

//Conexión BD
include '..\conexion.php';
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
        $productID = $_REQUEST['id'];
        // Obtener datos del carrito
        $query = $db->query("SELECT * FROM producto WHERE producto_id = ".$productID);
        $row = $query->fetch_assoc();
        $itemData = array(
            'id' => $row['producto_id'],
            'name' => $row['producto_nombre'],
            'size' => $row['producto_talla'],
            'color' => $row['producto_color'],
            'price' => $row['producto_precio'],
            'qty' => 1
        );
        
        $insertItem = $cart->insert($itemData);
        $redirectLoc = $insertItem?'verCarrito.php':'index.php';
        header("Location: ".$redirectLoc);
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
        $deleteItem = $cart->remove($_REQUEST['id']);
        header("Location: verCarrito.php");
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['sessCustomerID'])){
        // Insertar datos del pedido en BD
        $payment_method = $_POST['payment_method'];
        $insertOrder = $db->query("INSERT INTO pedido (customer_id, total_price,payment_method, created, modified) VALUES ('".$_SESSION['sessCustomerID']."', '".$cart->total()."', '".$payment_method."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");
        
        if($insertOrder){
            $orderID = $db->insert_id;
            $sql = '';
            // Obtener items del carrito
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO productos_pedido (order_id, product_id, name, size, color, quantity) VALUES ('".$orderID."', '".$item['id']."', '".$item['name']."', '".$item['size']."','".$item['color']."', '".$item['qty']."');";
                $sql .= "UPDATE producto SET producto_sold = (producto_sold + '".$item['qty']."'), producto_stock = (producto_cantidad - producto_sold) WHERE producto_id = '".$item['id']."';";
            }
            // Insertar items del pedido en BD
            $insertOrderItems = $db->multi_query($sql);
            
            if($insertOrderItems){
                $cart->destroy();
                header("Location: ordenPedido.php?id=$orderID");
            }else{
                header("Location: pago.php");
            }
        }else{
            header("Location: tienda.php");
        }
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}