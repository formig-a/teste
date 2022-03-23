<?php
    require_once 'usuarios.php';
    $u = new Usuario();
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <?php include "navbar.php"; ?>
<div id="corpo-form">
    <h1>Entrar</h1>
    <form method="post">
        <input type="text" name="nome" placeholder="Nome" maxlength="30">
        <input type="text" name="cidade" placeholder="Cidade" maxlength="30">
        <input type="text" name="telefone" placeholder="Telefone" maxlength="20">
        <input type="text" name="endereço" placeholder="Endereço" maxlength="50">
        <input type="text" name="cep" placeholder="Cep" maxlength="10">
        <input type="email" name="email" placeholder="email" maxlength="40">
        <input type="password" name="senha" placeholder="Senha" maxlength="15">
        <input type="password" name="confSenha" placeholder="Confirmar senha">
        <input type="submit" value="Cadastrar">
    </form>
</div>
<?php
if (isset($_POST['nome']))
{
    $nome = addslashes($_POST['nome']);
    $cidade = addslashes($_POST['cidade']);
    $telefone = addslashes($_POST['telefone']);
    $endereço = addslashes($_POST['endereço']);
    $cep = addslashes($_POST['cep']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $confirmarSenha = addslashes($_POST['confSenha']);
    if (!empty($nome) && !empty($cidade) && !empty($telefone) && !empty($endereço) && !empty($cep) && !empty($email) && !empty($senha) && !empty($confirmarSenha))
    {
        $u->conectar("db_shopping_cart", "localhost", "root", "");
        if ($u->msgErro == "")
        {
            if ($senha == $confirmarSenha){
                if ($u->cadastrar($nome,$cidade,$telefone,$endereço, $cep, $email, $senha)){
                    ?>
                    <div id="msg-sucesso">
                        Cadastrado com sucesso
                    </div>
                <?php
                }else {
                    ?>
                    <div class="msg-erro">
                        Email já cadastrado
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="msg-erro">
                    As senhas não correspondem
                </div>
                <?php
            }

        }else {
            ?>
            <div class="msg-erro">
               <?php echo "Erro: ".$u->msgErro;?>
            </div>
            <?php
        }
    }else {
        ?>
        <div class="msg-erro">
            Preencha todos os campos!
        </div>
        <?php
    }
}

?>
</body>
</html>
