<?php
require_once "../src/funcoes-fabricantes.php";
require_once "../src/funcoes-produtos.php";

$fabricantes = lerFabricantes($conexao);

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$produtos = lerUmProduto($conexao, $id);

if (isset($_POST['atualizar'])){
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    
    $preco = filter_input(INPUT_POST, "preco", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    $quantidade = filter_input(INPUT_POST, "quantidade", FILTER_SANITIZE_NUMBER_INT);

    $fabricanteId = filter_input(INPUT_POST, "fabricante", FILTER_SANITIZE_NUMBER_INT);

    $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS);

    atualizarProduto(
        $conexao, $id, $nome, $quantidade, $descricao, $fabricanteId
    );

    header("location:visualizar.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Atualização</title>
</head>
<body>
    
    <h1>Produtos | SELECT/UPDATE</h1>
    <hr>

    <form action="" method="post">
        <p>
            <label for="nome">Nome:</label>
            <input type="text" value="<?=$produtos['nome']?>" name="nome" id="nome" required>
        </p>

        <p>
            <label for="preco">Preço:</label>
            <input type="number" value="<?=$produtos['preco']?>" min="10" max="10000" step="0.01" name="preco" id="preco" required>
        </p>

        <p>
            <label for="quantidade">Quantidade:</label>
            <input type="number" value="<?=$produtos['quantidade']?>" min = "1" max="100" name="quantidade" id="quantidade" required>
        </p>

        <p>
            <label for="fabricante">Fabricante:</label>
            <select name="fabricante" id="fabricante">

            <option value=""></option>
            <?php foreach($fabricantes as $fabricante) { ?>
                <option <?php if($produtos["fabricante_id"] === $fabricante["id"]) echo " selected" ; ?> 
                value="<?=$fabricante["id"]?>"><?=$fabricante["nome"]?></option>
            <?php } ?>
            
            </select>
            
        </p>

        <p>
            <label for=""></label>
            <textarea name="descricao" id="descricao" cols="30" rows="3"><?=$produtos['descricao']?></textarea>
        </p>
    
        <button type="submit" name="atualizar">Atualizar Produto</button>
    </form>

    <hr>


    <p>
        <a href="visualizar.php">Voltar</a>
    </p>

</body>
</html>