<?php

class Produto_class
{
    private $pdo;

    public function __construct($dbname,$host,$usuario,$senha)
    {
        try {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$usuario,$senha);
        }catch (PDOException $e)
        {
            echo 'Erro com banco de dados: '.$e->getMessage();
        } catch (PDOException $e)
        {
            echo 'Erro genérico: '.$e->getMessage();
        }
    }

    public function enviarProduto($nome,$preco,$quantidade,$descricao,$fotos = array())
    {
        $cmd = $this->pdo->prepare('INSERT INTO produto(nome,preco,quantidade,descricao) values (:n, :p, :q, :d)');
        $cmd->bindValue(':n',$nome);
        $cmd->bindValue(':p',$preco);
        $cmd->bindValue(':q',$quantidade);
        $cmd->bindValue(':d', $descricao);
        $cmd->execute();
        $id_produto = $this->pdo->lastInsertId();
        if (count($fotos) > 0)
        {
            for ($i=0; $i < count($fotos); $i++)
            {
                $nome_foto = $fotos[$i];
                $cmd = $this->pdo->prepare('INSERT INTO imagem(nome_imagem, fk_id_produto) VALUES (:n, :fk)');
                $cmd->bindValue(':n', $nome_foto );
                $cmd->bindValue(':fk', $id_produto);
                $cmd->execute();
            }
        }
    }

    public function buscarProdutos()
    {
        $cmd = $this->pdo->prepare('SELECT image,description,name, city, contact, address, pincode, total_amt, pname, qty, order_no FROM users 
        INNER JOIN orders on (users.uid = orders.uid)
        INNER JOIN order_details on (orders.oid = order_details.oid)
        INNER JOIN products on (order_details.pid = products.pid)');
        $cmd->execute();
        if ($cmd->rowCount() > 0)
        {
            $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $dados = array();
        }
        return $dados;
    }
}