<?php
//Inicializar sesión
session_start();
include('..\inc\header.php');
include('..\inc\container.php');
include('..\inc\menu.php');
////Incluye fichero conexion
require_once "..\conexion.php";
?>

<div class="container">
    <div class="row">
        <div class="box" style="border-radius:10 px;">
            <div class="col-lg-12">
            <hr>
			<h2 class="intro-text text-center">Últimas <strong> Novedades</strong></h2>
			<hr>
            </div><br></br>
        </div>
    </div>
      <?php 
         //Variables
         /*$c_id = $c_nombre = $c_talla = $c_color = $c_precio = $c_descripcion = $c_imagen = "";
         //Declaración
         $sql = "SELECT * FROM `articulos` ORDER BY `created` LIMIT 6";
         $resultado = mysqli_query($db,$sql);     
        //Guardar resultado en objetos
        while ($fila = mysqli_fetch_object($resultado)) {
        $c_id = $fila -> id ;
        $c_nombre = $fila -> name;
        $c_talla = $fila -> size;
        $c_color = $fila -> color;
        $c_prize = $fila -> prize;
        $c_descripcion = $fila -> description;
        $c_imagen = $fila -> image;
        echo '	
		<div class="col-sm-4 col-lg-4 col-md-4">
             <div class="thumbnail">
				<h4 style="text-align: center;">'.$c_nombre.'</h4>
                <img class="img-responsive img-border img-left" src="data:image;base64,'.$c_imagen.'" alt="imagen">
                <div class="caption">
					<p><strong>Nombre Producto:</strong> '.$c_nombre.'</p>
					<p><strong>Tallas Disponibles:</strong> '.$c_talla.'</p>
					<p><strong>Colores Disponibles:</strong> '.$c_color.'</p>
					<p><strong>Precio: $ '.$c_prize.'.00</strong></p>
                    <p><strong>Descripción:</strong> '.$c_descripcion.'</p>
                </div>
				<center><a onclick="addToCartOnclick('.$c_id.');" href="#"  style="margin-bottom: 5px;" class="btn btn-primary">Agregar al Carro</a></center>
            </div>
        </div>
		';*/
        
        
        //Guardar el resutado en arry
        /*while ($fila = mysqli_fetch_array($resultado)) {
        echo'	
		<div class="row">
			<div class="box" style="border-radius: 10px;">
				<div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Top '. $fila[1].'</h2>
                    <hr>
                    <img class="img-responsive img-border img-left" src="data:image;base64,'.$fila[8].'" alt="imagen">
                    <hr class="visible-xs">
				    	<p><strong>Nombre Producto:</strong> '.$fila[1].'</p>
				    	<p><strong>Tallas Disponibles:</strong> '.$fila[3].'</p>
				    	<p><strong>Colores Disponibles:</strong> '.$fila[4].'</p>
				    	<p><strong>Precio: $ '.$fila[5].'.00</strong></p>
                        <p><strong>Descripción:</strong> '.$fila[6].'</p>
                        <a class="btn btn-success" href="accionCarrito.php?action=addToCart&id=<?php echo $fila[0]; ?>">Agregar al Carro</a>
                </div>
            </div>
        </div>
		';
      }*/
         
        // Obtener filas de la consulta
        $query = $db->query("SELECT * FROM producto ORDER BY producto_id DESC LIMIT 10");
        if ($query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
        ?>
        <div class="thumbnail">
            <div class="box" style="border-radius: 10px;">
               <div class="col-lg-12"> 
                   <hr>
                   <h2 class="intro-text text-center"><?php echo $row["producto_nombre"]; ?></h2>
                   <hr>
                   <img class="img-thumbnail img-border img-left" src="../gestion/img/producto/<?php echo $row["producto_foto"]; ?>" style="width:440px !important; height:330px !important" alt="imagen">
                   <hr class="visible-xs">
                       <p><strong>Nombre Producto:</strong><?php echo $row["producto_nombre"]; ?></p>
                       <p><strong>Tallas Disponibles:</strong><?php echo " " .$row["producto_talla"]; ?></p>
                       <p><strong>Colores Disponibles:</strong> <?php echo $row["producto_color"]; ?></p>
                       <p><strong>Precio: € <?php echo $row["producto_precio"]; ?></strong></p>
                       <p><strong>Descripción:</strong><?php echo $row["producto_descripcion"]; ?></p>
                       <a class="btn btn-success" href="accionCarrito.php?action=addToCart&id=<?php echo $row["producto_id"]; ?>">Enviar al Carrito</a>
                </div>
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