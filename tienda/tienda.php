<?php
//Inicializar sesión
session_start();
include('..\inc\header.php');
include('..\inc\container.php');
include('..\inc\menu.php');
//Incluye fichero conexion
require_once "..\conexion.php";
?>

<div class="container">
      <?php /*
         //Variables
         $c_id = $c_nombre = $c_talla = $c_color = $c_precio = $c_descripcion = $c_imagen = "";
         //Declaración
         $sql = "SELECT * FROM `articulos` ORDER BY `price`";
         $resultado = mysqli_query($db,$sql);     
        //Guardar resultado en objetos
        while ($fila = mysqli_fetch_object($resultado)) {
        $c_id = $fila -> id ;
        $c_nombre = $fila -> name;
        $c_talla = $fila -> size;
        $c_color = $fila -> color;
        $c_price = $fila -> price;
        $c_descripcion = $fila -> description;
        $c_imagen = $fila -> image;
        echo '	
		<div class="col-sm-4 col-lg-4 col-md-4">
             <div class="thumbnail">
				<h4 style="text-align: center;">'.$c_nombre.'</h4>
                <img style="border: 2px solid gray; border-radius: 10px; " src="data:image;base64,'.$c_imagen.'" alt="imagen">
                <div class="caption">
					<p><strong>Nombre Producto:</strong> '.$c_nombre.'</p>
					<p><strong>Tallas Disponibles:</strong> '.$c_talla.'</p>
					<p><strong>Colores Disponibles:</strong> '.$c_color.'</p>
					<p><strong>Precio: $ '.$c_price.'.00</strong></p>
                    <p><strong>Descripción:</strong> '.$c_descripcion.'</p>
                </div>
				<center><a class="btn btn-success" href="accionCarrito.php?action=addToCart&id=<?php echo $cd_id["id"]; ?>">Enviar al Carrito</a></center>
            </div>
        </div>
		';
        
        /*
        //Guardar el resutado en arry
        while ($fila = mysqli_fetch_array($resultado)) {
        echo'	
		<div class="col-sm-4 col-lg-4 col-md-4">
             <div class="thumbnail">
				<h4 style="text-align: center;">'.$fila[1].'</h4>
                <img style="border: 2px solid gray; border-radius: 10px; " src="data:image;base64,'.$fila[8].'" alt="imagen">
                <div class="caption">
					<p><strong>Nombre Producto:</strong> '.$fila[1].'</p>
					<p><strong>Tallas Disponibles:</strong> '.[3].'</p>
					<p><strong>Colores Disponibles:</strong> '.$fila[4].'</p>
					<p><strong>Precio: $ '.$fila[5].'.00</strong></p>
                    <p><strong>Descripción:</strong> '.$fila[6].'</p>
                </div>
				<center><a onclick="addToCartOnclick('.$fila[0].');" href="#"  style="margin-bottom: 5px;" class="btn btn-primary">Agregar al Carro</a></center>
            </div>
        </div>
		';
      }*/
      //Declaración selección productos
      $query = $db->query("SELECT * FROM producto ORDER BY producto_id DESC LIMIT 9");
      if ($query->num_rows > 0) {
          while ($row = $query->fetch_assoc()) {
      ?>
      <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
				<h4 style="text-align: center;"><?php echo $row["producto_nombre"]; ?></h4>
                <img class="img-fluid img-border 2px solid gray; border-radius: 10px;" src="../gestion/img/producto/<?php echo $row["producto_foto"]; ?>" style="width:440px !important; height:330px !important" alt="imagen">
                <div class="caption">
					<p><strong>Nombre Producto:</strong><?php echo $row["producto_nombre"]; ?></p>
					<p><strong>Tallas Disponibles:</strong><?php echo " " .$row["producto_talla"]; ?></p>
					<p><strong>Colores Disponibles:</strong> <?php echo $row["producto_color"]; ?></p>
					<p><strong>Precio: € <?php echo $row["producto_precio"]; ?></strong></p>
                    <p><strong>Descripción:</strong><?php echo $row["producto_descripcion"]; ?></p>
                </div>
				<center><a class="btn btn-success" href="accionCarrito.php?action=addToCart&id=<?php echo $row["producto_id"]; ?>">Enviar al Carrito</a></center>
            </div>
        </div>
                        <?php }
                    } else { ?>
                        <p>Producto(s) no existe.....</p>
                    <?php } ?>
</div>


<?php include('..\inc\footer.php')?>
<script> src = "..\bootstrap\js\bootstrap.js" </script>
<script> src = "..\bootstrap\js\min.js" </script>
<script> function añadirCarrito(id){
    if (confirm("Producto añadido a tu cesta") == true) {
        window.open("pedidos.php?id="+id,"_self",null,true);
    }
}</script>