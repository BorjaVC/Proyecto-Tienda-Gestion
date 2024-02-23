<?php
	require_once "main.php";

	// Almacenar id
    $id=limpiar_cadena($_POST['pedido_id']);


    // Verificar pedido 
	$check_pedido=conexion();
	$check_pedido=$check_pedido->query("SELECT * FROM pedido WHERE id='$id'");

    if($check_pedido->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La categoría no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_pedido->fetch();
    }
    $check_pedido=null;

    // Almacenar datos 
    $estado=limpiar_cadena($_POST['pedido_estado']);
    $modificado=date('Y-m-d H:i:s');


    // Actualizar datos 
    $actualizar_pedido=conexion();
    $actualizar_pedido=$actualizar_pedido->prepare("UPDATE pedido SET status=:estado,modified=:modificado WHERE id=:id");

    $marcadores=[
        ":estado"=>$estado,
        ":modificado"=>$modificado,
        ":id"=>$id
    ];

    if($actualizar_pedido->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡Pedido ACTUALIZADO!</strong><br>
                El pedido Nº ' . $id . ' se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el pedido, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_pedido=null;