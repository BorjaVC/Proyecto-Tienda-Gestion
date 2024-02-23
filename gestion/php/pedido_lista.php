<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";
    global $cliente_id;
	if(isset($busqueda) && $busqueda!=""){

		$consulta_datos="SELECT * FROM pedido WHERE id LIKE '%busqueda%' OR customer_id LIKE '%$busqueda%' OR id LIKE '%$busqueda%' ORDER BY id DESC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(id) FROM pedido WHERE id LIKE '%$busqueda%' OR customer_id LIKE '%$busqueda%'";

	}elseif($cliente_id>0){
		$consulta_datos="SELECT * FROM pedido WHERE customer_id='$cliente_id' ORDER BY id ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(id) FROM pedido WHERE customer_id='$cliente_id'";

	}else{

		$consulta_datos="SELECT * FROM pedido ORDER BY id DESC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(id) FROM pedido";
		
	}

	$conexion=conexion();

	$datos = $conexion->query($consulta_datos);
	$datos = $datos->fetchAll();

	$total = $conexion->query($consulta_total);
	$total = (int) $total->fetchColumn();

	$Npaginas =ceil($total/$registros);

	$tabla.='
	<div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                	<th>#</th>
                    <th>Identificador</th>
                    <th>Cliente ID</th>
                    <th>Importe</th>
                    <th>Fecha Creación</th>
                    <th>Fecha Modificado</th>
                    <th>Estado</th>
                    <th colspan="3">Opciones</th>
                </tr>
            </thead>
            <tbody>
	';

	if($total>=1 && $pagina<=$Npaginas){
		$contador=$inicio+1;
		$pag_inicio=$inicio+1;
		foreach($datos as $rows){
			$tabla.='
				<tr class="has-text-centered" >
					<td>'.$contador.'</td>
                    <td>'.$rows['id'].'</td>
                    <td>'.$rows['customer_id'].'</td>
                    <td>'.$rows['total_price'].'</td>
                    <td>'.$rows['created'].'</td>
                    <td>'.$rows['modified'].'</td>
                    <td>'.$rows['status'].'</td>
                    <td>
                        <a href="index.php?vista=order_detail&id='.$rows['id'].'" class="button is-link is-rounded is-small">Ver pedido</a>
                    </td>
                    <td>
                        <a href="index.php?vista=order_update&order_id_up='.$rows['id'].'" class="button is-success is-rounded is-small">Actualizar</a>
                    </td>
                    <td>
                        <a href="'.$url.$pagina.'&order_id_del='.$rows['id'].'" class="button is-danger is-rounded is-small">Eliminar</a>
                    </td>
                </tr>
            ';
            $contador++;
		}
		$pag_final=$contador-1;
	}else{
		if($total>=1){
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="5">
						<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
							Haga clic aquí para recargar el listado
						</a>
					</td>
				</tr>
			';
		}else{
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="5">
						No hay registros en el sistema
					</td>
				</tr>
			';
		}
	}


	$tabla.='</tbody></table></div>';

	if($total>0 && $pagina<=$Npaginas){
		$tabla.='<p class="has-text-right">Mostrando pedidos <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
	}

	$conexion=null;
	echo $tabla;

	if($total>=1 && $pagina<=$Npaginas){
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}