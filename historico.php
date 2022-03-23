<!DOCTYPE html>
<html>
<head>
    <title>Histórico de pedidos</title>
    <meta charset="utf-8">
</head>
<body>
    <?php
    require 'Produto_Class.php';
   
    $p = new Produto_class('db_shopping_cart','localhost','root','');
    $dadosProduto = $p->buscarProdutos();
    if (empty($dadosProduto))
    {
        echo "Nenhuma compra realizada!";
         } else
    {
        ?><h1>Pedidos</h1>
        <?php
    foreach ($dadosProduto as $value)
    {
        ?>
        <form>
            <h5>Número da compra: <?php echo $value['order_no'] ?></h5>
            <h5>Cliente: <?php echo $value['name']; ?></h5>
            <h5>Total: <?php echo $value['total_amt']; ?></h5>
            <h5>Produto: <?php echo $value['pname']; ?></h5>
            <h5>Quantidade: <?php echo $value['qty']; ?></h5>
            #
        </form>
   <?php } 
    } ?>

</body>
</html>

