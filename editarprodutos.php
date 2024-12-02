<?php
session_start();
include 'conexao.php';

// Verifica se o ID foi enviado
if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Busca os dados do produto no banco
    $query = $cn->prepare("SELECT * FROM vw_Roupa WHERE cod_Roupa = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $produto = $query->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        header("Location: adm.php?msg=Produto não encontrado!");
        exit;
    }
} else {
    header("Location: adm.php?msg=ID inválido!");
    exit;
}

// Atualiza o produto se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $nome = $_POST['nome_Roupa'];
        $descricao = $_POST['desc_Roupa'];
        $valor = $_POST['valor_Roupa'];
        $tamanho = $_POST['tamanho_Roupa'];
        $cor = $_POST['cor'];
        $marca = $_POST['nome_Marca'];
        $estoque = $_POST['qtn_estoque'];
        $categoria = $_POST['desc_categoria'];

        $updateQuery = $cn->prepare("
            UPDATE vw_Roupa 
            SET nome_Roupa = :nome, desc_Roupa = :descricao, valor_Roupa = :valor,
                tamanho_Roupa = :tamanho, cor = :cor, nome_Marca = :marca, 
                qtn_estoque = :estoque, desc_categoria = :categoria
            WHERE cod_Roupa = :id
        ");
        $updateQuery->bindParam(':nome', $nome);
        $updateQuery->bindParam(':descricao', $descricao);
        $updateQuery->bindParam(':valor', $valor);
        $updateQuery->bindParam(':tamanho', $tamanho);
        $updateQuery->bindParam(':cor', $cor);
        $updateQuery->bindParam(':marca', $marca);
        $updateQuery->bindParam(':estoque', $estoque);
        $updateQuery->bindParam(':categoria', $categoria);
        $updateQuery->bindParam(':id', $id, PDO::PARAM_INT);
        $updateQuery->execute();

        header("Location: adm.php?msg=Produto atualizado com sucesso!");
        exit;
    } catch (PDOException $e) {
        echo "Erro ao atualizar o produto: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Editar Produto</h2>
    <form action="" method="POST">
        <input type="text" name="nome_Roupa" class="form-control" value="<?php echo $produto['nome_Roupa']; ?>" required><br>
        <textarea name="desc_Roupa" class="form-control" required><?php echo $produto['desc_Roupa']; ?></textarea><br>
        <input type="number" name="valor_Roupa" class="form-control" value="<?php echo $produto['valor_Roupa']; ?>" required><br>
        <input type="text" name="tamanho_Roupa" class="form-control" value="<?php echo $produto['tamanho_Roupa']; ?>" required><br>
        <input type="text" name="cor" class="form-control" value="<?php echo $produto['cor']; ?>" required><br>
        <input type="text" name="nome_Marca" class="form-control" value="<?php echo $produto['nome_Marca']; ?>" required><br>
        <input type="number" name="qtn_estoque" class="form-control" value="<?php echo $produto['qtn_estoque']; ?>" required><br>
        <select name="desc_categoria" class="form-control" required>
            <option value="feminino" <?php echo ($produto['desc_categoria'] == 'feminino') ? 'selected' : ''; ?>>Feminino</option>
            <option value="masculino" <?php echo ($produto['desc_categoria'] == 'masculino') ? 'selected' : ''; ?>>Masculino</option>
            <option value="calcado" <?php echo ($produto['desc_categoria'] == 'calcado') ? 'selected' : ''; ?>>Calçado</option>
            <option value="acessorios" <?php echo ($produto['desc_categoria'] == 'acessorios') ? 'selected' : ''; ?>>Acessórios</option>
        </select><br>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="adm.php" class="btn btn-default">Cancelar</a>
    </form>
</div>
</body>
</html>
