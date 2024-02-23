<div class="container is-fluid mb-6">
    <h1 class="title">Pedidos</h1>
    <h2 class="subtitle">Lista de pedidos</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
        include "./inc/btn_back.php";
        
        require_once "./php/main.php";

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
        $url="index.php?vista=order_list&page="; 
        $registros=10;
        $busqueda="";

        //Paginador pedido
        require_once "./php/pedido_lista.php";
    ?>
</div>