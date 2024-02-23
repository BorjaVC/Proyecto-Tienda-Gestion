<div class="container is-fluid mb-6">
    <h1 class="title">Pedido</h1>
    <h2 class="subtitle">Detalles del Pedido</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
        include "./inc/btn_back.php";
        
        require_once "./php/main.php";
    ?>
    <div class="columns">
        
        <div class="column">
            <?php
                $pedido_id = (isset($_GET['id'])) ? $_GET['id'] : 0;
                $campos="pedido.id, pedido.customer_id, usuario.id, usuario.firstname, usuario.lastname, usuario.lastname2, usuario.phone, usuario.address";

                // Verificar pedido 
                $check_pedido=conexion();
                $check_pedido=$check_pedido->query("SELECT $campos FROM pedido INNER JOIN usuario ON pedido.customer_id =usuario.id WHERE pedido.id='$pedido_id'");

                if($check_pedido->rowCount()>0){

                    $check_pedido=$check_pedido->fetch();

                    echo '
                        <h2 class="title has-text-centered">Pedido Nº'.$check_pedido['id'].'</h2>
                        <p class="has-text-centered pb-6" ><strong> Cliente: </strong>'.$check_pedido['firstname']." ".$check_pedido['lastname']." ".$check_pedido['lastname2'].", ".$check_pedido['phone'].", ".$check_pedido['address'].'</p>
                    ';

                    require_once "./php/main.php";

                    // Eliminar producto 
                    if(isset($_GET['product_id_del'])){
                        require_once "./php/pedido_eliminar.php";
                    }

                    if(!isset($_GET['page'])){
                        $pagina=1;
                    }else{
                        $pagina=(int) $_GET['page'];
                        if($pagina<=1){
                            $pagina=1;
                        }
                    }

                    $pagina=limpiar_cadena($pagina);
                    $url="index.php?vista=order_detail&id=$pedido_id&page="; 
                    $registros=10;
                    $busqueda="";

                    // Paginador producto 
                    require_once "./php/pedido_detalle.php";

                }else{
                    echo '<h2 class="has-text-centered title" >Seleccione un pedido para empezar</h2>';
                }
                $check_categoria=null;
            ?>
        </div>
    </div>
</div>