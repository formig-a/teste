<?php 
	include "config.php";
	session_start();
	
	include "cart.class.php";
	$cart=new Cart();
	
	if(isset($_POST["submit"])){
		
		$name=mysqli_real_escape_string($con,$_POST["name"]);
		$email=mysqli_real_escape_string($con,$_POST["email"]);
		$contact=mysqli_real_escape_string($con,$_POST["contact"]);
		$address=mysqli_real_escape_string($con,$_POST["address"]);
		$city=mysqli_real_escape_string($con,$_POST["city"]);
		$pincode=mysqli_real_escape_string($con,$_POST["pincode"]);
		#insert User Details
		$sql="insert into users (NAME,EMAIL,CONTACT,ADDRESS,CITY,PINCODE) values ('{$name}','{$email}','{$contact}','{$address}','{$city}','{$pincode}')";
		if($con->query($sql)){
			$uid=$con->insert_id;

			#insert Order information
			$order_no=rand(10000,100000);
			$total_amt=$cart->get_cart_total();
			$sql="insert into orders (ORDER_NO,UID,TOTAL_AMT) values ('{$order_no}','{$uid}','{$total_amt}')";
			if($con->query($sql)){
				$oid=$con->insert_id;
				
				#insert Order Item Details
				$sql="insert into order_details (OID,PID,PNAME,PRICE,QTY,TOTAL) values ";
				$rows=[];
				foreach($cart->get_all_items() as $item){
					$rows[]="('{$oid}','{$item["id"]}','{$item["name"]}','{$item["price"]}','{$item["qty"]}','{$item["total"]}')";
				}
				$sql.=implode(",",$rows);
				if($con->query($sql)){
					$cart->destroy();
					header("location:complete.php?order_no={$order_no}");
				}
			}
			
		}
		
	}
?>
<html>
	<head>
        <title>Finalizar compra</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    </head>
    <body>
		<?php include "navbar.php"; ?>
        <div class='container mt-5'>
			<h2 class='text-muted mb-4'>Finalizar compra</h2>
			<div class='row'>
				<div class='col-md-6 mx-auto'>
					<form method='post' action='<?php echo $_SERVER["REQUEST_URI"];?>' autocomplete="off">
						<div class='form-group'>
							<label></label>Nome
							<input type='text' name='name' class='form-control' required placeholder='Nome completo'>
						</div>
						<div class='form-group'>
							<label></label>Email
							<input type='email' name='email' class='form-control' required placeholder='Email'>
						</div>
						<div class='form-group'>
							<label></label>Telefone
							<input type='text' name='contact' class='form-control' required placeholder='XX-XXXXX-XXXX'>
						</div>
						<div class='form-group'>
							<label></label>Endereço
							<textarea class='form-control' required name='address'></textarea>
						</div>
						<div class='form-group'>
							<label></label>Cidade
							<input type='text' name='city' class='form-control' required placeholder='Cidade'>
						</div>
						<div class='form-group'>
							<label></label>Cep
							<input type='text' name='pincode' class='form-control' required placeholder='Cep'>
						</div>
						<input type='submit' name='submit' value='Confirmar compra' class='btn btn-primary'>
					</form>
				</div>
			</div>
		</div>
    </body>
</html> 