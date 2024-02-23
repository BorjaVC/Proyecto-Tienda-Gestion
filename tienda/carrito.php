<?php session_start();

// Verificar si el usuario ha iniciado sesión, si no, redirígirlo a la página de inicio de sesión
if (!isset($_SESSION["loggedin"])|| $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
//Si la sesión es iniciada con un rol diferente al de usuario redirigir al usuario a la págin que le corresponde
}elseif ($_SESSION["role"] !="Cliente"){
    header("location: ..\admin\adminAccount.php");
    exit;
}
class Cart {
    protected $cart_contents = array();
    
    public function __construct(){
        // obtener array del carrito de compras de la sesión
        $this->cart_contents = !empty($_SESSION['cart_contents'])?$_SESSION['cart_contents']:NULL;
		if ($this->cart_contents === NULL){
			// establecer valores iniciales
			$this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
		}
    }
    
    /**
	 * Contenido del carrito: devuelve array del carrito
	 * @param	bool
	 * @return	array
	 */
	public function contents(){
		// Reorganizar el más nuevo primero
		$cart = array_reverse($this->cart_contents);

		// Eliminar valores iniciales
		unset($cart['total_items']);
		unset($cart['cart_total']);

		return $cart;
	}
    
    /**
	 * Obtener artículo del carrito: devuelve los detalles de un artículo específico del carrito
	 * @param	string	$row_id
	 * @return	array
	 */
	public function get_item($row_id){
		return (in_array($row_id, array('total_items', 'cart_total'), TRUE) OR ! isset($this->cart_contents[$row_id]))
			? FALSE
			: $this->cart_contents[$row_id];
	}
    
    /**
	 * Total Items: Returns the total item count
	 * @return	int
	 */
	public function total_items(){
		return $this->cart_contents['total_items'];
	}
    
    /**
	 * Total carrito: Devuelve el contenido total
	 * @return	int
	 */
	public function total(){
		return $this->cart_contents['cart_total'];
	}
    
    /**
	 * Inserta artículos en el carrito y los guarda en la sesión
	 * @param	array
	 * @return	bool
	 */
	public function insert($item = array()){
		if(!is_array($item) OR count($item) === 0){
			return FALSE;
		}else{
            if(!isset($item['id'], $item['name'], $item['price'], $item['qty'])){
                return FALSE;
            }else{
                /*
                 * Insertar item
                 */
                // Prepara la cantidad
                $item['qty'] = (float) $item['qty'];
                if($item['qty'] == 0){
                    return FALSE;
                }
                // Prepara el precio
                $item['price'] = (float) $item['price'];
                // Crear un identificador único para el artículo que se inserta en el carrito
                $rowid = md5($item['id']);
                // Obtiene la cantidad si ya y la agrega
                $old_qty = isset($this->cart_contents[$rowid]['qty']) ? (int) $this->cart_contents[$rowid]['qty'] : 0;
                // Volver a crear la entrada con un identificador único y una cantidad actualizada
                $item['rowid'] = $rowid;
                $item['qty'] += $old_qty;
                $this->cart_contents[$rowid] = $item;
                
                // Guardar artículo del carrito
                if($this->save_cart()){
                    return isset($rowid) ? $rowid : TRUE;
                }else{
                    return FALSE;
                }
            }
        }
	}
    
    /**
	 * Modificar el carrito
	 * @param	array
	 * @return	bool
	 */
	public function update($item = array()){
		if (!is_array($item) OR count($item) === 0){
			return FALSE;
		}else{
			if (!isset($item['rowid'], $this->cart_contents[$item['rowid']])){
				return FALSE;
			}else{
				// Prepara la cantidad
				if(isset($item['qty'])){
					$item['qty'] = (float) $item['qty'];
					// Eliminar el artículo del carrito si la cantidad es cero
					if ($item['qty'] == 0){
						unset($this->cart_contents[$item['rowid']]);
						return TRUE;
					}
				}
				
				
				$keys = array_intersect(array_keys($this->cart_contents[$item['rowid']]), array_keys($item));
				// Preparar el precio
				if(isset($item['price'])){
					$item['price'] = (float) $item['price'];
				}
				// la identificación y el nombre del producto no deben cambiarse
				foreach(array_diff($keys, array('id', 'name')) as $key){
					$this->cart_contents[$item['rowid']][$key] = $item[$key];
				}
				// Guardar datos del carrito
				$this->save_cart();
				return TRUE;
			}
		}
	}
    
    /**
	 * Guardar array del carrito en la sesión
	 * @return	bool
	 */
	protected function save_cart(){
		$this->cart_contents['total_items'] = $this->cart_contents['cart_total'] = 0;
		foreach ($this->cart_contents as $key => $val){
			// Asegurar valores array
			if(!is_array($val) OR !isset($val['price'], $val['qty'])){
				continue;
			}
	 
			$this->cart_contents['cart_total'] += ($val['price'] * $val['qty']);
			$this->cart_contents['total_items'] += $val['qty'];
			$this->cart_contents[$key]['subtotal'] = ($this->cart_contents[$key]['price'] * $this->cart_contents[$key]['qty']);
		}
		
		// Si el carrito está vacío, se elimina de la sesión
		if(count($this->cart_contents) <= 2){
			unset($_SESSION['cart_contents']);
			return FALSE;
		}else{
			$_SESSION['cart_contents'] = $this->cart_contents;
			return TRUE;
		}
    }
    
    /**
	 * Remove Item: Removes an item from the cart
	 * @param	int
	 * @return	bool
	 */
	 public function remove($row_id){
		
		unset($this->cart_contents[$row_id]);
		$this->save_cart();
		return TRUE;
	 }
     
    /**
	 * Eliminar artículo: elimina un artículo del carrito
	 * @return	void
	 */
	public function destroy(){
		$this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
		unset($_SESSION['cart_contents']);
	}
}