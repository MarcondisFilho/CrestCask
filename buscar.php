<?php
// Conexão com o banco de dados
include 'conexao.php';
include 'nav.php'; // Inclui o menu de navegação

// Verificando se o termo de busca foi passado
if (isset($_GET['termo_busca'])) {
    // Captura o termo de busca
    $termo_busca = $_GET['termo_busca'];

    // Consulta no banco de dados para buscar produtos semelhantes
    $consulta = $cn->prepare("SELECT * FROM vw_Roupa WHERE nome_Roupa LIKE :termo_busca OR desc_Roupa LIKE :termo_busca");
    $consulta->execute([':termo_busca' => '%' . $termo_busca . '%']);

    // Exibindo os resultados
    if ($consulta->rowCount() > 0) {
        echo "<h2>Resultados da pesquisa para: <strong>$termo_busca</strong></h2>";
        echo "<div class='row'>"; // Inicia a linha de resultados

        while ($produto = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='col-sm-3'>"; // Cada produto ocupa uma coluna

            // Exibe o produto com o mesmo estilo da página inicial
            echo "<div class='produto'>";
            echo "<div class='produto-imagem'>";
            echo "<img src='img/{$produto['desc_imagem']}.jpg' class='img-responsive' style='width:100%;' alt='{$produto['nome_Roupa']}'>";
            echo "</div>";
            echo "<div class='produto-info'>";
            echo "<h4><a href='produto.php?cod={$produto['cod_Roupa']}'>" . $produto['nome_Roupa'] . "</a></h4>";
            echo "<p>R$ " . number_format($produto['valor_Roupa'], 2, ',', '.') . "</p>";
            echo "<p>{$produto['desc_Roupa']}</p>";
            echo "</div>"; // Fim do produto
            echo "</div>"; // Fim da coluna
            echo "</div>"; // Fim da linha
        }

        echo "</div>"; // Fim da div row
    } else {
        echo "<p>Nenhum produto encontrado para o termo: <strong>$termo_busca</strong>.</p>";
    }
} else {
    echo "<p>Por favor, insira um termo de busca.</p>";
}
?>

<!-- Estilo da Página de Busca -->
<style>
  .navbar{
    height:100px;
    padding-top:30px;
    padding-left:6%;
    padding-right:6%;
    box-shadow: 0px -30px 80px #222;
  }

  .navbar-header{
    width:30%;
    margin-top:-10px;
  }

  #imgLogo{
    width:50%;
  }

  a{
    display: inline;
    color:#888;
    font-size:15px;
  }

  a:hover{
    background:#fff!important;
  }

  #boxBuscar{
    height:40px;
    border-radius:20px;
  }

  #bntBuscar{
    border:none;
    margin-left:-50px;
  }

  #user{
    width:32px;
    margin-top:-2px;
  }

  #btnAdm{
    margin:-26px 20px 0px 20px;
  }

  /* Estilo dos produtos */
  .produto {
    margin-bottom: 30px;
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    text-align: center;
  }

  .produto-imagem img {
    width: 100%;
    height: auto;
    border-radius: 10px;
  }

  .produto-info {
    margin-top: 10px;
  }

  .produto-info h4 {
    font-size: 18px;
    color: #333;
    margin-bottom: 10px;
  }

  .produto-info p {
    font-size: 16px;
    color: #666;
  }

  /* Estilos para a barra de pesquisa */
  .navbar-form {
    padding: 10px;
    margin-top: 25px;
  }

  .navbar-form .form-control {
    width: 300px;
    margin-right: 10px;
  }
</style>
