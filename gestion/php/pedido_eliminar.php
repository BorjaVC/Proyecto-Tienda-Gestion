<?php

	// Almacenar datos 
    $order_id_del=limpiar_cadena($_GET['order_id_del']);

    //Verificar pedido
    $check_pedido=conexion();
    $check_pedido=$check_pedido->query("SELECT id FROM pedido WHERE id='$order_id_del'");
    
    if($check_pedido->rowCount()==1){
    		
	    	$eliminar_pedido=conexion();
	    	$eliminar_pedido=$eliminar_pedido->prepare("DELETE FROM pedido WHERE id=:id AND status = 'Realizado'");

	    	$eliminar_pedido->execute([":id"=>$order_id_del]);

	    	if($eliminar_pedido->rowCount()==1){
		        echo '
		            <div class="notification is-info is-light">
		                <strong>¡PEDIDO ELIMINADO!</strong><br>
		                Los datos del pedido Nº ' . $order_id_del . ' se eliminaron con exito
		            </div>
		        ';
		    }else{
		        echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Ocurrio un error inesperado!</strong><br>
		                No se pudo eliminar el pedido, por favor compruebe el estado del pedido e intentelo nuevamente
		            </div>
		        ';
		    }
		    $eliminar_pedido=null;
    	
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El PEDIDO que intenta eliminar no existe
            </div>
        ';
    }
    $check_pedido=null;