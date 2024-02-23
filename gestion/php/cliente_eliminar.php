<?php
	//Almacenar datos
    $customer_id_del=limpiar_cadena($_GET['customer_id_del']);

    // Verificar usuario
    $check_cliente=conexion();
    $check_cliente=$check_cliente->query("SELECT * FROM usuario WHERE id='$customer_id_del'");
    
    if($check_cliente->rowCount()==1){

    	$check_pedido=conexion();
    	$check_pedido=$check_pedido->query("SELECT customer_id FROM pedido WHERE customer_id='$customer_id_del' LIMIT 1");

    	if($check_pedido->rowCount()<=0){

    		$eliminar_cliente=conexion();
	    	$eliminar_cliente=$eliminar_cliente->prepare("DELETE usuario,cliente FROM usuario  JOIN cliente ON usuario.username=cliente.username WHERE usuario.id=:id");

	    	$eliminar_cliente->execute([":id"=>$customer_id_del]);

	    	if($eliminar_cliente->rowCount()==2){

				$check_cliente=$check_cliente->fetch();
		        echo '
		            <div class="notification is-info is-light">
		                <strong>¡CLIENTE ELIMINADO!</strong><br>
		                Los datos del cliente con Login <strong> '. $check_cliente['username'] .'</strong>  Email  <strong> '. $check_cliente['email'] . ' </strong> se eliminaron con exito
		            </div>
		        ';
		    }else{
		        echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Ocurrio un error inesperado!</strong><br>
		                No se pudo eliminar el CLIENTE, por favor intentelo nuevamente
		            </div>
		        ';
		    }
		    $eliminar_cliente=null;
    	}else{
    		$eliminar_cliente=conexion();
	    	$eliminar_cliente=$eliminar_cliente->prepare("DELETE usuario,cliente,pedido FROM usuario INNER JOIN cliente ON usuario.username=cliente.username INNER JOIN pedido ON usuario.id=pedido.customer_id WHERE usuario.id=:id");

	    	$eliminar_cliente->execute([":id"=>$customer_id_del]);

			if($eliminar_cliente->rowCount()>=2){

				$check_cliente=$check_cliente->fetch();
		        echo '
		            <div class="notification is-info is-light">
		                <strong>¡CLIENTE ELIMINADO!</strong><br>
		                Los datos del cliente con Login <strong> '. $check_cliente['username'] .'</strong>  Email  <strong> '. $check_cliente['email'] . ' </strong> se eliminaron con exito
		            </div>
		        ';
		    }else{
		        echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Ocurrio un error inesperado!</strong><br>
		                No se pudo eliminar el CLIENTE, por favor intentelo nuevamente
		            </div>
		        ';
		    }
		    $eliminar_cliente=null;

    	}
    	$check_articulos=null;
    }else{
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La CLIENTE que intenta eliminar no existe
            </div>
        ';
    }
    $check_cliente=null;