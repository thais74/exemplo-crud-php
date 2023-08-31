<?php 
require_once "../src/funcoes-fabricantes.php";
require_once "../src/funcoes-produtos.php";

$fabricantes = lerFabricantes($conexao);

if(isset($_POST['inserir'])){
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    
    $preco = filter_input(INPUT_POST, "preco", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    $quantidade = filter_input(INPUT_POST, "quantidade", FILTER_SANITIZE_NUMBER_INT);

    $fabricanteId = filter_input(INPUT_POST, "fabricante", FILTER_SANITIZE_NUMBER_INT);

    $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS);

    inserirProduto($conexao, $nome, $preco, $quantidade, $fabricanteId, $descricao);

    header("location:visualizar.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Inserção</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        * { box-sizing: border-box; }
    </style>
</head>
<body>
    <div class="container-md">
        <br>
        <h1>Produtos | Insert</h1>
    <hr>

    <form action="" method="post">
        <p>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>
        </p>

        <p>
            <label for="preco">Preço:</label>
            <input type="number" min="10" max="10000" step="0.01" name="preco" id="preco" required>
        </p>

        <p>
            <label for="quantidade">Quantidade:</label>
            <input type="number" min = "1" max="100" name="quantidade" id="quantidade" required>
        </p>

        <p>
            <label for="fabricante">Fabricante:</label>
            <select name="fabricante" id="fabricante">

            <option value=""></option>
            <?php foreach($fabricantes as $fabricante) { ?>
                <option value="<?=$fabricante["id"]?>"><?=$fabricante["nome"]?></option>
            <?php } ?>
            
            </select>
            
        </p>

        <p>
            <label for=""></label>
            <textarea name="descricao" id="descricao" cols="30" rows="3"></textarea>
        </p>
    
        <button type="submit" name="inserir">Inserir Produto</button>
    </form>

    <hr>


    <p>
        <a href="visualizar.php">Voltar</a>
    </p>
    </div>
    
</body>
</html>