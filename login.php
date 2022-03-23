<?php
require_once 'usuarios.php';
$u = new Usuario()
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div id="corpo-form">
        <h1>Entrar</h1>
        <form method="post">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="senha" placeholder="Senha">
            <input type="submit" value="ACESSAR">
            <a href="cadastro.php"><strong>Cadastre-se</strong></a>
        </form>
    </div>
<?php
if (isset($_POST['email']))
{
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    if (!empty($email) && !empty($senha))
    {
        $u->conectar("db_shopping_cart","localhost","root","");
        if ($u->msgErro == "")
        {
        if ($u->logar($email,$senha))
        {
            echo "Logado com sucesso";
        } else {
            echo "Email e/ou senha estão incorretos";
        }
    } else {
            echo "Erro: ".$u->msgErro;
        }
    } else {
      echo "Preencha todos os campos";
    }
}
?>
</body>
</html>