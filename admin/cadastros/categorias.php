<!-- formulario com campo id, nome e botao -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <form method="post" action="salvar/categorias">
                <label for="id">ID da Categoria</label>
                <input type="text" name="id" id="id" class="form-control" value="" placeholder="">

                <label for="nome">Nome da Categoria</label>
                <input type="text" name="nome" id="nome" class="form-control" required value="" placeholder="">
                <br>
                <button type="submit" class="btn btn-success">Salvar Dados</button>
            </form>
        </div>
    </div>
</body>

</html>