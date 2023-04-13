<?php

//pegar do POST o valor do campo nome ou seja, gravar numa variavel
$nome = $_POST["nome"] ?? NULL;


var_dump($nome);

$sql = "SELECT nome FROM categoria where nome = :nome";

//a linha seguinte significa: insira dentro de CATEGORIA, na coluna NOME, o valor da variavel NOME
$sql = "INSERT INTO categoria (nome) VALUES (:nome)";

//preparando o sql do INSERT, ou seja, o último que foi feito, pois ele sobrescreve
$consulta = $pdo->prepare($sql);

$consulta->bindParam(":nome", $nome);
$consulta->execute();



//fazer a conexao do pdo
//criar o sql de create, para cadastrar na tabela de categoria