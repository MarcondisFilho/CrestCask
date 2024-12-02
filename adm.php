<?php
session_start();
include 'conexao.php';  // Certifique-se de que o caminho para o arquivo de conexão esteja correto

// Lógica para adicionar produto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adicionar_produto'])) {
    // Recebe os dados do formulário
    $nome_Roupa = $_POST['nome_Roupa'];
    $desc_Roupa = $_POST['desc_Roupa'];
    $valor_Roupa = $_POST['valor_Roupa'];
    $tamanho_Roupa = $_POST['tamanho_Roupa'];
    $cor = $_POST['cor'];
    $nome_Marca = $_POST['nome_Marca'];
    $qtn_estoque = $_POST['qtn_estoque'];
    $desc_imagem = $_FILES['desc_imagem']['name']; // Nome do arquivo de imagem
    $desc_categoria = $_POST['desc_categoria'];

       // Verificando se o arquivo foi enviado
    if (isset($_FILES['desc_imagem']) && $_FILES['desc_imagem']['error'] == 0) {
        // Pegando o nome original do arquivo e a extensão
        $arquivo_nome = $_FILES['desc_imagem']['name'];
        $arquivo_tmp = $_FILES['desc_imagem']['tmp_name'];
        $arquivo_ext = pathinfo($arquivo_nome, PATHINFO_EXTENSION); // Pegando a extensão

        // Usando apenas o nome do arquivo, sem a extensão
        $arquivo_nome_sem_ext = pathinfo($arquivo_nome, PATHINFO_FILENAME);

        // Definindo o caminho para salvar o arquivo na pasta img (mantendo o nome original sem a extensão)
        $pasta_destino = 'img/';
        $caminho_destino = $pasta_destino . $arquivo_nome_sem_ext . '.' . $arquivo_ext;

        // Movendo o arquivo para a pasta de destino
        if (move_uploaded_file($arquivo_tmp, $caminho_destino)) {
            // O arquivo foi movido com sucesso, agora inserir os dados no banco de dados
            $query = "INSERT INTO vw_Roupa (nome_Roupa, desc_Roupa, valor_Roupa, tamanho_Roupa, cor, nome_Marca, qtn_estoque, desc_imagem, desc_categoria)
                      VALUES ('$nome_Roupa', '$desc_Roupa', '$valor_Roupa', '$tamanho_Roupa', '$cor', '$nome_Marca', '$qtn_estoque', '$arquivo_nome_sem_ext', '$desc_categoria')";

            // Executando a query no banco de dados
            $cn->exec($query);

            echo "Produto adicionado com sucesso!";
        } else {
            echo "Erro ao fazer upload da imagem.";
        }
    } else {
        echo "Nenhuma imagem foi enviada ou ocorreu um erro.";
    }
}

?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Painel de Administração</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .panel-heading {
            background-color: #f1f1f1;
            font-size: 20px;
            text-align: center;
        }

        .panel {
            margin-bottom: 20px;
        }

        .form-control {
            width: 50%;
            margin: 10px auto;
        }

        .btn {
            width: 50%;
            margin: 10px auto;
        }

        .table {
            width: 100%;
            margin-top: 20px;
        }

        .text-center {
            text-align: center;
        }

        h1 {
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        #btnAdcProduto {
            margin-top: 10px;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <!-- Sidebar do painel de admin -->
            <div class="col-sm-3">
                <div class="list-group">
                    <a href="#" class="list-group-item active">Painel de Administração</a>
                    <a href="#" class="list-group-item">Adicionar Produto</a>
                    <a href="#" class="list-group-item">Gerenciar Produtos</a>
                    <a href="index.php" class="list-group-item">Sair</a>
                </div>
            </div>

            <!-- Conteúdo principal -->
            <div class="col-sm-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Adicionar Produto</div>
                    <div class="panel-body">
                        <form action="adm.php" method="POST" enctype="multipart/form-data">
                            <input type="text" name="nome_Roupa" class="form-control" placeholder="Nome do Produto" required><br>
                            <textarea name="desc_Roupa" class="form-control" placeholder="Descrição do Produto" required></textarea><br>
                            <input type="number" name="valor_Roupa" class="form-control" placeholder="Preço" required><br>
                            <input type="text" name="tamanho_Roupa" class="form-control" placeholder="Tamanho" required><br>
                            <input type="text" name="cor" class="form-control" placeholder="Cor" required><br>
                            <input type="text" name="nome_Marca" class="form-control" placeholder="Marca" required><br>
                            <input type="number" name="qtn_estoque" class="form-control" placeholder="Quantidade em Estoque" required><br>
                            <input type="file" name="desc_imagem" class="form-control" required><br>
                            <select name="desc_categoria" class="form-control" required>
                                <option value="feminino">Feminino</option>
                                <option value="masculino">Masculino</option>
                                <option value="calcado">Calçado</option>
                                <option value="acessorios">Acessórios</option>
                            </select><br>
                            <button type="submit" class="btn btn-success" name="adicionar_produto" id="btnAdcProduto">Adicionar Produto</button>
                        </form>
                    </div>
                </div>

                <!-- Tabela de produtos -->
                <div class="panel panel-default">
                    <div class="panel-heading">Gerenciar Produtos</div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Preço</th>
                                    <th>Categoria</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Exemplo de código para listar os produtos
                                $consulta = $cn->query("SELECT * FROM vw_Roupa");
                                while ($produto = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>
                                            <td>{$produto['cod_Roupa']}</td>
                                            <td>{$produto['nome_Roupa']}</td>
                                            <td>R$ " . number_format($produto['valor_Roupa'], 2, ',', '.') . "</td>
                                            <td>{$produto['desc_categoria']}</td>
                                            <td>
                                                <a href='editarprodutos.php?id={$produto['cod_Roupa']}' class='btn btn-warning btn-sm'>Editar</a>
                                                <a href='deletarprodutos.php?id={$produto['cod_Roupa']}' class='btn btn-danger btn-sm'>Excluir</a>
                                            </td>
                                          </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>