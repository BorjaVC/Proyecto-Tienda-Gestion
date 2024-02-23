<?php
//Inicializar sesión
session_start();
include('..\inc\header.php');
include ('..\inc\container.php');
//Incluye fichero conexion
require_once "..\conexion.php";
?>

<?php include('..\inc\menu.php'); ?>
<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <div id="carousel-example-generic" class="carousel slide">
                    <ol class="carousel-indicators hidden-xs">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="5"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="6"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="7"></li>
                    </ol>
    
                    <div class="carousel-inner">
                        <div class="item active">
                            <img class="img-responsive img-full" src="../img2/slide_1.PNG" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive img-full" src="../img2/slide_2.PNG" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive img-full" src="../img2/slide_3.PNG" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive img-full" src="../img2/slide_4.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive img-full" src="../img2/slide_5.PNG" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive img-full" src="../img2/slide_6.PNG" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive img-full" src="../img2/slide_7.PNG" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive img-full" src="../img2/slide_8.PNG" alt="">
                        </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="icon-prev"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="icon-next"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php
        //Declaración
      $query = $db->query("SELECT * FROM producto WHERE producto_id IN (44,47,49,17,18,19,55,58,61,38,39,40) ORDER BY producto_id DESC LIMIT 12");
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
<script>
		$('.carousel').carousel({
			interval: 5000 //changes the speed
		})
</script>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>