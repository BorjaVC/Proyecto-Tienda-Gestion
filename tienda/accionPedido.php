<?php
session_start();

//Valiable en la que almacenamos la acción solicitada
$ordenAccion = $_GET["ordenAccion"];

//Conexión BD
require '..\conexion.php';

//Acción ver pedido
if ($ordenAccion == "Ver") {
    $ordenID = $_GET['ordenID'];
    $sql = "SELECT * pedido_artculos WHERE id = " . $ordenID;
    $resultado = mysqli_query($db,$sql);
    if (isset($_GET['ordenID'])) {
        header("location: verPedido.php");
    }else {
        echo '<script>window.alert("¡FALLO! El pedido no pudede ser visto");window.open("userAccount.php","self",null,true)</script>';
    }

//Acción cancelar pedido
}elseif ($ordenAccion == "Cancelar") {
    $ordenID = $_GET["ordenID"];
    mysqli_query ($db ,"DELETE FROM pedido WHERE status = 'Realizado' AND id = " . $ordenID);
    $resultado = mysqli_affected_rows($db);

    if ($resultado == 1) {
        echo '<script>window.alert("¡El pedido fue cancelado!");window.open("userAccount.php","self",null,true)</script>';

    }else{
        echo '<script>window.alert("¡FALLO! El pedido no pudo ser cancelado. Solo pueden ser cancelados aquellos pedidos cuyo estado sea \"REALIZADO\".");window.open("userAccount.php","self",null,true)</script>';
    }
}
?>
