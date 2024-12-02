<?php
session_start();
include 'conexao.php';

// Verifica se o ID do produto foi enviado
if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Comando para deletar o produto do banco
        $deleteQuery = $cn->prepare("DELETE FROM vw_Roupa WHERE cod_Roupa = :id");
        $deleteQuery->bindParam(':id', $id, PDO::PARAM_INT);
        $deleteQuery->execute();

        // Redireciona de volta para a página de administração
        header("Location: adm.php?msg=Produto excluído com sucesso!");
        exit;
    } catch (PDOException $e) {
        echo "Erro ao excluir o produto: " . $e->getMessage();
    }
} else {
    header("Location: adm.php?msg=ID inválido!");
    exit;
}
?>
