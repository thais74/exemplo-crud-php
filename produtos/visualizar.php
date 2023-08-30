<?php
require_once "../src/funcoes-produtos.php";
require_once "../src/funcoes-utilitarias.php";
$listaDeProdutos = lerProdutos($conexao);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Visualizações</title>

    <style>
        * { box-sizing: border-box; }
        .produtos {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            width: 80%;
            margin: auto;
        }

        .produto {
            font-family: 'SEGOE UI';
            background-color: pink;
            padding: 1rem;
            width: 49%;
            box-shadow: black 3px 3px;
        }
    </style>


</head>
<body>
    
    <h1>Produtos | SELECT - <a href="../index.php">Home</a></h1>

    <hr>
    <h2>Lendo e carregando todos os produtos.</h2>

    <p> <a href="inserir.php">Inserir novo produto</a> </p>

    <div class = "produtos">

        <?php foreach($listaDeProdutos as $produto) { ?>
            <article class= "produto">
                <h3>Nome do produto:  <?=$produto["produto"]?></h3>
                <h4>Fabricante: <?=$produto["fabricante"]?></h4>
                <p><b>Preço:</b>  <?=formatarPreco($produto["preco"])?></p>
                <p><b>Quantidade:</b>   <?=$produto["quantidade"]?></p>
                <p><b>Total:</b> <?=formatarPreco($produto["preco"] * $produto["quantidade"])?></p>
                <p>
                    <a href="atualizar.php?">Editar </a>
            
                    <a href="apagar.php">Excluir</a>
                </p>
            </article>
        <?php } ?> 

    </div>

</body>
</html>