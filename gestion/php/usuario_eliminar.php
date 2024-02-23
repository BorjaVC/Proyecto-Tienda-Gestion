<?php

	// Almacenar datos 
    $user_id_del=limpiar_cadena($_GET['user_id_del']);

    //Verificar usuario
    $check_usuario=conexion();
    $check_usuario=$check_usuario->query("SELECT * FROM usuario WHERE id='$user_id_del'");
    
    if($check_usuario->rowCount()==1){

    	$check_pedido=conexion();
    	$check_pedido=$check_pedido->query("SELECT id FROM pedido WHERE customer_id='$user_id_del' LIMIT 1");

		$eliminar_usuario=conexion();
		$eliminar_usuario=$eliminar_usuario->prepare("DELETE usuario,administrador FROM usuario JOIN administrador ON usuario.email=administrador.email WHERE usuario.id=:id");
		$eliminar_usuario->execute([":id"=>$user_id_del]);
		if($eliminar_usuario->rowCount()==2){

			$check_usuario=$check_usuario->fetch();
	        echo '
	            <div class="notification is-info is-light">
	                <strong>¡USUARIO ELIMINADO!</strong><br>
	                Los datos del usuario con Login <strong>'. $check_usuario['username'] . "</strong>" . " con Email " . "<strong>" . $check_usuario['email'] . "</strong>" . ' se eliminaron con exito
	            </div>
	        ';
	    }else{
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No se pudo eliminar el usuario, por favor intente nuevamente
	            </div>
	        ';
	    }
	    $eliminar_usuario=null;
    }else{
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            El USUARIO que intenta eliminar no existe
        </div>
    ';
    }
    $check_usuario=null;