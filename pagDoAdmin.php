<?php

    require_once "conexao.php";

    $consulta = 'SELECT name, total_amt, pname, image, description,city, contact, pincode, address  FROM users 
INNER JOIN orders on (users.uid = orders.uid)
INNER JOIN order_details on (orders.oid = order_details.oid)
INNER JOIN products on (order_details.pid = products.pid)';
    $con = $mysqli->query($consulta) or die($mysqli->error);

    session_start();
    if (!isset($_SESSION['id_usuario']))
    {
        header("location: login.php");
        exit;
    }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Página do admin</title>
</head>
<body>
    <section>
    <?php
    require 'Produto_Class.php';
    require 'navbar.php';
    $p = new Produto_class('db_shopping_cart','localhost','root','');
    $dadosProduto = $p->buscarProdutos();
    if (empty($dadosProduto))
    {
        echo "Nenhuma compra realizada";
    } else
    {
        ?><h1>Pedidos</h1> <?php
    foreach ($dadosProduto as $value)
    {
        ?>
        <h5>Número da compra: <?php echo $value['order_no'] ?></h5>
        <h5>Cliente: <?php echo $value['name']; ?></h5>
        <h5>Total: <?php echo $value['total_amt']; ?></h5>
        <h5>Produto: <?php echo $value['pname']; ?></h5>
        <h5>Quantidade: <?php echo $value['qty']; ?></h5>
   <?php } 
    } ?>
    </section>
    <section>
    <?php
    $p = new Produto_class('db_shopping_cart','localhost','root','');
    $dadosProduto = $p->buscarProdutos();
    if (empty($dadosProduto))
    {
        echo "Nenhuma compra realizada";
    } else
    {
        ?><h1>Produtos</h1> <?php
    foreach ($dadosProduto as $value)
    {
        ?>
        <img src="images/<?php echo $value['image']; ?>" >
        <h5>Descrição: <?php echo $value['description']; ?></h5>
        <h5>Quantidade: <?php echo $value['qty']; ?></h5>
   <?php } 
    } ?>
</section>
<section>
    <?php
    $p = new Produto_class('db_shopping_cart','localhost','root','');
    $dadosProduto = $p->buscarProdutos();
    if (empty($dadosProduto))
    {
        echo "Nenhuma compra realizada";
    } else
    {
        ?><h1>Dados cadastrais</h1> <?php
    foreach ($dadosProduto as $value)
    {
        ?>
        
        <h5>Nome: <?php echo $value['name'] ?></h5>
        <h5>Cidade: <?php echo $value['city']; ?></h5>
        <h5>Telefone: <?php echo $value['contact']; ?></h5>
        <h5>Endereço: <?php echo $value['address']; ?></h5>
        <h5>Cep: <?php echo $value['pincode']; ?></h5>
   <?php } 
    } ?>
</section>
</body>
</html>