<div class="container is-fluid mb-6">
    <h1 class="title">Cliente</h1>
    <h2 class="subtitle">Pedidos</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
        include "./inc/btn_back.php";

        require_once "./php/main.php";
    ?>
    <div class="columns">
        <div class="column">
            <?php
                $cliente_id = (isset($_GET['id'])) ? $_GET['id'] : 0;

                // Verificar cliente 
                $check_cliente=conexion();
                $check_cliente=$check_cliente->query("SELECT * FROM usuario WHERE id='$cliente_id'");

                if($check_cliente->rowCount()>0){

                    $check_cliente=$check_cliente->fetch();

                    echo '
                        <h2 class="title has-text-centered">Pedidos Cliente</h2>
                        <p class="has-text-centered pb-6" ><strong>'.$check_cliente['firstname']." ".$check_cliente['lastname']." ".$check_cliente['lastname2'].'</strong></p>
                    ';


                    //Eliminar pedido
                    if(isset($_GET['order_id_del'])){
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
                    $url="index.php?vista=customer_orders&id=$cliente_id&page="; 
                    $registros=10;
                    $busqueda="";
            
                    //Paginador pedido
                    require_once "./php/pedido_lista.php";

                }else{
                    echo '<h2 class="has-text-centered title" >Seleccione un pedido para empezar</h2>';
                }
                $check_categoria=null;
            ?>
        </div>
    </div>
</div>