	<?php
	
	//Conexion a la base de datos 
	function conexion(){
		$pdo = new PDO('mysql:host=localhost;dbname=tienda', 'root', '');
		return $pdo;
	}

	//Verificar datos 
	function verificar_datos($filtro,$cadena){
		if(preg_match("/^".$filtro."$/", $cadena)){
			return false;
        }else{
            return true;
        }
	}

    //Limpiar cadenas de texto 
	function limpiar_cadena($cadena){
		$cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		$cadena=str_ireplace("<script>", "", $cadena);
		$cadena=str_ireplace("</script>", "", $cadena);
		$cadena=str_ireplace("<script src", "", $cadena);
		$cadena=str_ireplace("<script type=", "", $cadena);
		$cadena=str_ireplace("SELECT * FROM", "", $cadena);
		$cadena=str_ireplace("DELETE FROM", "", $cadena);
		$cadena=str_ireplace("INSERT INTO", "", $cadena);
		$cadena=str_ireplace("DROP TABLE", "", $cadena);
		$cadena=str_ireplace("DROP DATABASE", "", $cadena);
		$cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
		$cadena=str_ireplace("SHOW TABLES;", "", $cadena);
		$cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
		$cadena=str_ireplace("<?php", "", $cadena);
		$cadena=str_ireplace("?>", "", $cadena);
		$cadena=str_ireplace("--", "", $cadena);
		$cadena=str_ireplace("^", "", $cadena);
		$cadena=str_ireplace("<", "", $cadena);
		$cadena=str_ireplace("[", "", $cadena);
		$cadena=str_ireplace("]", "", $cadena);
		$cadena=str_ireplace("==", "", $cadena);
		$cadena=str_ireplace(";", "", $cadena);
		$cadena=str_ireplace("::", "", $cadena);
		$cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		return $cadena;
	}

	//Funcion paginador de tablas 
	function paginador_tablas($pagina,$Npaginas,$url,$botones){
		$tabla='<nav aria-label>
		<ul class="pagination  justify-content-center">';

		if($pagina<=1){
			$tabla.='
			<li class="page-item ">
			<a class="pagination-previous is-disabled" disabled >Anterior</a>
			</li>
			';
		}else{
			$tabla.='
			<li class="page-item ">
			<a class="pagination-previous" href="'.$url.($pagina-1).'" >Anterior</a>
			</li>
				<li><a class="pagination-link" href="'.$url.'1">1</a></li>
				<li><span class="pagination-ellipsis">&hellip;</span></li>
			';
		}

		$ci=0;
		for($i=$pagina; $i<=$Npaginas; $i++){
			if($ci>=$botones){
				break;
			}
			if($pagina==$i){
				$tabla.='<li class="page-item active" aria-current="page"><a class="pagination-link is-current " href="'.$url.$i.'">'.$i.'</a></li>';
			}else{
				$tabla.='<li><a class="pagination-link" href="'.$url.$i.'">'.$i.'</a></li>';
			}
			$ci++;
		}

		if($pagina==$Npaginas){
			$tabla.='
			<li class="page-item ">
			<a class="pagination-next is-disabled" disabled >Siguiente</a>
			</li>
			';
		}else{
			$tabla.='
			<li><span class="pagination-ellipsis ">&hellip;</span></li>
			<li><a class="pagination-link" href="'.$url.$Npaginas.'">'.$Npaginas.'</a></li>
			<li class="page-item ">
			<a class="pagination-next" href="'.$url.($pagina+1).'" >Siguiente</a>
			</li>
			';
		}

		$tabla.='
		</ul>
		</nav>';
		return $tabla;
	}    