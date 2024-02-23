<?php
//Inicializar sesión
session_start();
include('..\inc\header.php');
include('..\inc\container.php');
include('..\inc\menu.php');

//Incluye fichero conexion
require_once "accionPagina.php";

if(!isset($_GET['page'])){
    $pagina=1;
}else{
    $pagina=(int) $_GET['page'];
    if($pagina<=1){
        $pagina=1;
    }
}

$pagina=limpiar_cadena($pagina);
$url="tienda2.php?page=";
$registros=9;
$busqueda="";
?>

<div class="container">
      <?php 
      $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
      $tabla="";
      //Declaración selección productos
      $consulta_datos = ("SELECT * FROM producto ORDER BY producto_id ASC LIMIT $inicio,$registros");
      $consulta_total = ("SELECT COUNT(producto_id) FROM producto");

      $conexion = conexion();
      $datos = $conexion -> query ($consulta_datos);
      $datos = $datos -> fetchAll();

      $total = $conexion -> query($consulta_total);
      $total = (int) $total -> fetchColumn();

      $Npaginas =ceil($total/$registros);


      if ($total >= 1 && $pagina<=$Npaginas) {
        $contador = $inicio +1;
        $pag_inicio = $inicio +1;
        foreach($datos as $row) {
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
                        <?php $contador++;}
                        $pag_final=$contador-1;
                    } else { ?>
                        <p>Producto(s) no existe.....</p>
                    <?php }
                    if($total>0 && $pagina<=$Npaginas){
                        $tabla.='<p class="has-text-right">Mostrando productos <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
                    }
                
                    $conexion=null;
                    echo $tabla;
                
                    if($total>=1 && $pagina<=$Npaginas){
                        echo paginador_tablas($pagina,$Npaginas,$url,7);
                    } ?>
</div>



<?php include('..\inc\footer.php')?>
<script> src = "..\bootstrap\js\bootstrap.js" </script>
<script> src = "..\bootstrap\js\min.js" </script>
<script> function añadirCarrito(id){
    if (confirm("Producto añadido a tu cesta") == true) {
        window.open("pedidos.php?id="+id,"_self",null,true);
    }
}</script>