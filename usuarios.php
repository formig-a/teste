<?php


class Usuario {

    private $pdo;
    public $msgErro = "";
    public function conectar($nome, $host, $usuario, $senha)
    {
        global $pdo;
        try {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        } catch (PDOException $e) {
            $msgERRO  = $e->getMessage();
        }

    }

    public function cadastrar($nome, $cidade, $telefone, $endereco, $cep, $email, $senha)
    {
        global $pdo;
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();
        if ($sql->rowcount() > 0)
        {
            return false;
        } else {
            $sql = $pdo->prepare("INSERT INTO usuarios(nome, cidade, telefone, endereco, cep, email, senha) VALUES (:n, :c, :t, :d, :p, :e, :s)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":c",$cidade);
            $sql->bindValue(":t",$telefone);
            $sql->bindValue(":d",$endereco);
            $sql->bindValue(":p",$cep);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            return true;
        }
    }

    public function logar($email, $senha)
    {
        global $pdo;
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND Senha = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();
        if ($sql->rowCount() > 0) {
           $dado = $sql->fetch();
           session_start();
            ($_SESSION['id_usuario'] = $dado ['id_usuario']);
           return true;
        }else {
            return false;
        }

    }
}