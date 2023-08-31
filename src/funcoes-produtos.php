<?php
require_once "conecta.php";

function lerUmProduto(PDO $conexao, int $idproduto):array{
    $sql = "SELECT * FROM produtos WHERE id = :id";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":id", $idproduto, PDO::PARAM_INT);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("Erro ao carregar: ".$erro->getMessage());
    }

    return $resultado;
}


function lerProdutos(PDO $conexao):array{

    // Versão 1 (dados somente da tabela produtos)
    /* $sql = "SELECT  nome, preco, quantidade FROM produtos ORDER BY nome";
    
    Versão 2 (dados das duas tabelas:produtos e fabricantes) */
    $sql = "SELECT
                produtos.id,
                produtos.nome AS produto,
                produtos.preco,
                produtos.quantidade,
                fabricantes.nome AS fabricante
                 
            FROM produtos INNER JOIN fabricantes 
            ON produtos.fabricante_id = fabricantes.id
            
            ORDER BY produto";

    try{
        $consulta = $conexao->prepare($sql);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    }catch(Exception $erro){
        die("Erro ao carregar produtos: ".$erro->getMessage());
    }

    return $resultado;
};

function inserirProduto(PDO $conexao, string $nome,  float $preco, int $quantidade, int $fabricanteId, string $descricao):void{
    $sql = "INSERT INTO produtos (
        nome, preco, quantidade, descricao, fabricante_id
    ) VALUES (
        :nome, :preco, :quantidade, :descricao, :fabricanteId
    ) ";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":nome", $nome, PDO:: PARAM_STR);

        /* no PDO, ao trabalhar com valores "quebrados" para os parâmetros nomeados, você deve
        usar a forma constante PARAM_STR. No momento, não há outra forma do PDO de lidar com valores deste 
        tipo devido aos diferentes tipos de dados que cada banco de dados suporta.  */
        $consulta->bindValue(":preco", $preco, PDO::PARAM_STR);

        $consulta->bindValue(":quantidade", $quantidade, PDO::PARAM_INT);
        $consulta->bindValue(":descricao", $descricao, PDO::PARAM_STR);
        $consulta->bindValue(":fabricanteId", $fabricanteId, PDO::PARAM_STR);
        $consulta->execute();

    }catch(Exception $erro){
        die("Erro ao inserir: ".$erro->getMessage());
    }
}

function atualizarProduto(PDO $conexao, int $id, string $nome,  float $preco, int $quantidade, string $descricao, int $fabricanteId):void{
    $sql = "UPDATE produtos SET nome = :nome WHERE id= :id";
    
    try{
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(":nome", $nome, PDO::PARAM_STR);   
        $consulta->bindValue(":id", $id, PDO::PARAM_INT);   
        $consulta->execute(); 
    }catch (Exception $erro) {
        die("Erro ao atualizar: ".$erro->getMessage());
    }
}
?>