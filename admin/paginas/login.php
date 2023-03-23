<?php
    if($_POST){
        $login = $_POST["login"] ?? NULL;
        $senha = $_POST["senha"] ?? NULL;
        
        //este é o SELECT mensionado no index.php, linha 2
        $sql = "select id, nome, login, senha from usuario where login = :login and ativo = 'S' limit 1";  
        //este :login, usa-se o : antes pra tratar como um PARAMETRO - segurança, não faz verificação - tratamento

        $consulta = $pdo->prepare($sql);    //$pdo está no config.php - prepara a consulta do sql
        $consulta->bindParam(":login", $login);     //joga ":login" para dentro da variável $login
        $consulta->execute();       //execute funcionará como se tivesse clicando em EXECUTAR no phpMyAdmin

        $dados = $consulta->fetch(PDO::FETCH_OBJ);      //formata o retorno do banco, para que possamos acessá-los.

        //var_dump($dados);

        //print_r(password_verify($senha, $dados->senha));
        //bill - usuario
        //gates - senha

        if (!isset($dados->id)){
            mensagemErro("Usuário não encontrado ou inativo.");
        } else if (!password_verify($senha, $dados->senha)){
            mensagemErro("Senha incorreta.");
        }

        $_SESSION["usuario"] = array(
            "id" => $dados->id,
            "nome" => $dados->nome,
            "login" => $dados->login
        );

        echo "<script>location.href='paginas/home'</script>";
        exit;

    }
?>

<div class="login">
    <h1 class="text-center">Efetuar Login</h1>
    <form method="POST">
        <label for="login">Login:</label>
        <input type="text" name="login" id="login" class="form-control" required placeholder="Por favor, preencha este campo">
        
        <br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" class="form-control" required placeholder="Por favor, preencha este campo">
        <br>

        <button type="submit" class="btn btn-success w-100">Efetuar Login</button>
    </form>
</div>