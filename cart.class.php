<?php 
if(!session_id()){
	session_start();
}

	class Cart{
		
		protected $cart_items=array();
		
		public function __construct(){
			
			if(!isset($_SESSION["cart"])){
				$_SESSION["cart"]=[];
			}
			
			$this->cart_items=$_SESSION["cart"];
		}
		
		#pega id dos itens
		public function get_ids(){
			$ids=[];
			foreach($this->cart_items as $item){
				$ids[]=$item["id"];
			}
			return $ids;
		}
		
		
		#add item no carrinho
		public function add_to_cart($item=[]){
			if(isset($item["id"],$item["name"],$item["price"],$item["qty"],$item["total"])){
				
				#verifica se o produto já está no carrinho
				$ids=$this->get_ids();
				if(in_array($item["id"],$ids)){
					
					#atualiza qty e total
					$this->cart_items[$item["id"]]["qty"]+=$item["qty"];
					$this->cart_items[$item["id"]]["total"]=$this->cart_items[$item["id"]]["qty"]*$item["price"];
				}else{
					
					#adiciona item no carrinho
					$this->cart_items[$item["id"]]=$item;
				}
				
				$this->commit();
				return true;
			}else{
				return false;
			}
		}
		
		#update qty do carrinho
		public function update_cart($item=[]){
			$this->cart_items[$item["id"]]["qty"]=$item["qty"];
			$this->cart_items[$item["id"]]["total"]=$this->cart_items[$item["id"]]["qty"]*$this->cart_items[$item["id"]]["price"];
			$this->commit();
			return true;
		}
		
		#remove item do carrinho
		public function remove($id){
			unset($this->cart_items[$id]);
			$this->commit();
		}
		
		#pega o total 
		public function get_cart_total(){
			#atualiza o total
			$sum=0;
			foreach($this->cart_items as $item){
				$sum+=$item["total"];
			}
			return $sum;
		}
		
		#conta os itens do carrinho
		public function get_cart_count(){
			return count($this->cart_items);
		}
		
		#atualiza valores da sessão
		public function commit(){
			$_SESSION["cart"]=$this->cart_items;
		}
		
		#destrói a sessão do carrinho
		public function destroy(){
			$this->cart_contents = array('cart_total' => 0, 'cart_items_count' => 0); 
			unset($_SESSION["cart"]);
		}
		
		#pega itemúnico do carrinho
		public function get_item($id){
			return $this->cart_items[$id];
		}
		
		#pega todo os itens do carrinho
		public function get_all_items(){
			return $this->cart_items;
		}
	}
?>