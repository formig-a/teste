<?php 
	include "config.php";
	session_start();
	  
	include "cart.class.php";
	$cart=new Cart();
  
	$data=[];
	$sql="select * from products";
	$res=$con->query($sql);
	if($res->num_rows>0){
		while($row=$res->fetch_assoc()){
			$data[]=$row;
		}
	}
?>
<html>
	<head>
        <title>Joca Shoes</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    </head>
    <body>
		<?php include "navbar.php"; ?>
        <div class='container mt-5 pb-5'>
			<div class='row'>
				<?php foreach($data as $row): ?>
					<div class='col-md-3 mt-2'>
						<div class="card">
						  <img class="card-img-top" src="images/<?php echo $row["IMAGE"]; ?>" >
						  <div class="card-body">
							<h5 class="card-title"><?php echo $row["PRODUCT"]; ?></h5>
							<p class="card-text">
								Preço: $<?php echo $row["PRICE"]; ?> 
							</p>
							<p class="card-text">
								Quantidade: CX <?php echo $row["QUANTITY"]; ?> 
							</p>
							<?php if ($row['QUANTITY'] >0) {
								?>  <a href="view_details.php?id=<?php echo $row["PID"]; ?>" class='btn btn-primary  float-right' >Comprar</a> <?php
							}else {
								?> <button class="btn btn-dark float-right">Esgotado</button> <?php 
							} ?>
							
						  </div>
						</div>
					</div>	
				<?php endforeach; ?>
			</div>
		</div>
    </body>
</html> 