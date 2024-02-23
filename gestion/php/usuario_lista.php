<?php
    $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";
    
    if(isset($busqueda) && $busqueda!=""){

		$consulta_datos="SELECT * FROM usuario WHERE ((id!='".$_SESSION['id']."') AND (firstname LIKE '%$busqueda%' OR lastname LIKE '%$busqueda%' OR username LIKE '%$busqueda%' OR email LIKE '%$busqueda%') AND (role = 'Administrador')) ORDER BY id ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(id) FROM usuario WHERE ((id!='".$_SESSION['id']."') AND (firstname LIKE '%$busqueda%' OR lastname LIKE '%$busqueda%' OR username LIKE '%$busqueda%' OR email LIKE '%$busqueda%') AND (role = 'Administrador'))";

	}else{

		$consulta_datos="SELECT * FROM usuario WHERE id!='".$_SESSION['id']."' AND role = 'Administrador' ORDER BY id ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(id) FROM usuario WHERE id!='".$_SESSION['id']."' AND role = 'Administrador'";
		
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
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Usuario</th>
					<th>ID</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th colspan="2">Opciones</th>
                </tr>
            </thead>
            <tbody>
	';

    if ($total >= 1 && $pagina<=$Npaginas) {
        $contador = $inicio +1;
        $pag_inicio = $inicio +1;
        foreach ($datos as $rows) {
            $tabla .= '
			    <tr class="has-text-centered" >
                    <td>' . $contador . '</td> 
                    <td>' . $rows['firstname'] . '</td>
                    <td>' . $rows['lastname'] . '</td>
                    <td>' . $rows['username'] . '</td>
                    <td>' . $rows['id'] . '</td>
                    <td>' . $rows['email'] . '</td>
                    <td>' . $rows['phone'] . '</td>
                    <td>' . $rows['address'] . '</td>
                    <td>
                        <a href="index.php?vista=user_update&user_id_up='.$rows['id'].'" class="button is-success is-rounded is-small">Actualizar</a>
                    </td>
                    <td>
                        <a href="'.$url.$pagina.'&user_id_del='.$rows['id'].'" class="button is-danger is-rounded is-small">Eliminar</a>
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
					<td colspan="7">
						<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
							Haz clic para recargar el listado
						</a>
					</td>
				</tr>
			';
		}else{
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="7">
						No hay registros en el sistema
					</td>
				</tr>
			';
		}
	}
    $tabla.='</tbody></table></div>';

	if($total>0 && $pagina<=$Npaginas){
		$tabla.='<p class="has-text-right">Mostrando usuarios <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
	}

	$conexion=null;
	echo $tabla;

	if($total>=1 && $pagina<=$Npaginas){
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}
?>