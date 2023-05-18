<?php
    //verificação para pegar os dados direto do banco de dados e não do usuário (garantia)
    $sql = "select id from categoria where id = :id";
    
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    $consulta->execute();

    $categoria = $consulta->fetch(PDO::FETCH_OBJ);

    //var_dump($categoria->id);

    if(empty($categoria->id)){
        mensagemErro("Não foi possível excluir esta categoria!");
    }

    $sql = "delete from categoria where id = :id";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $categoria->id);

    if($consulta->execute()){
        echo "<script>location.href='listar/categorias'</script>";
        exit;
    }

    //return no if para retornar função e não repetir if e else
?>

