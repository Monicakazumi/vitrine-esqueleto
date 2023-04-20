<?php
    if($_POST){
        //verifica se o id tem valor ou é nulo
        $id = $_POST["id"] ?? null;
        //verifica se o nome tem "valor" ou é nulo
        $nome = $_POST["nome"] ?? null;

        //valida se o campo nome é vazio - emite uma mensagem de erro
        if (empty($nome)){ //empty -> variável
            mensagemErro("Preencha o nome da categoria!");
        }

        //buscamos no banco se tem um registro já com o nome do parametro que estamos
        $sql = "select id from categoria where nome = :nome and id <> :id";
        //$consulta recebe a preparação do sql
        $consulta = $pdo->prepare($sql);
        //pegamos o parâmetro ":nome" e jogando na variável $nome
        $consulta->bindParam(":nome", $nome);
        //pegamos o parâmetro ":id" e jogando na variável $id
        $consulta->bindParam(":id", $id);
        //$consulta recebe a execução do sql tratado
        $consulta->execute();

        //$dados recebe as informações formatada do banco, transformando-o em Objeto
        $dados = $consulta->fetch(PDO::FETCH_OBJ); //formata as informações do banco - transformando em Objeto

        //verifica a condição da variável $dados não estar vazia indicando o id - mensagem de erro caso não esteja vazia
        if(!empty($dados->id)){
            mensagemErro("Já existe uma categoria cadastrada com esse ID");
        }

        //Caso a variável $id esteja vazia - insere o dado nome, já que o id se auto insere no banco
        if (empty($id)){
            $sql = "insert into categoria (nome) values (:nome)";
            //prepara o sql
            $consulta = $pdo->prepare($sql);
            //pega a informação inserida no ":nome" e passa para a variável $nome
            $consulta->bindParam(":nome", $nome);

        //Caso a variável $id não esteja vazia - atualiza a informação no banco, nas colunas nome e id
        }else {
            $sql = "update categoria set nome = :nome where id = :id";
            //preprara as informações do sql
            $consulta = $pdo->prepare($sql);
            //pega a informação inserida no ":nome" e passa para a variável $nome
            $consulta->bindParam(":nome", $nome);
            //pega a informação inserida no ":id" e passa para a variável $id
            $consulta->bindParam(":id", $id);
        }
        
        //Emite a mensagem caso não tenha iformação vindo do banco de dados
        if (!$consulta->execute()){
            mensagemErro("Não foi possivel salver os dados!");
        }

        //redireciona para o arquivo categorias que se encontra dentro da pasta listas
        echo "<script>location.href='listas/categorias'</script>";
        exit;

    }
