<!DOCTYPE HTML>
<html lang="pt-br"> <!-- indicando a linguagem que iremos usar no codigo html -->
<head>
<title>Crest Cask</title>
<meta charset="utf-8"> <!-- indicando o sistema de caractere utf-8 -->

<!--
	o nosso site será responsivo, para isto precisaremos usar uma metatag
	que irá conter informações da viewport(area que o site aparece no browser)
	Na viewport informaremos que a largura sera = a largura da janela
    do meu navegador (Browser), seja em um tablet ou celular.
 -->
<meta name="viewport" content="width=device-width,initial-scale=1">

<!-- CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- JavaScript compilado-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style type="text/css">
    .navbar{ margin-bottom: 0;}

	.row{
		width: 80%;
		margin-left:10%;
		margin-bottom:6%
	}

	#boxProd{
		margin-top:4%;
	}

	#imgPord{
		height:300px;
		margin-top:5%;
		margin-bottom:12px;
	}

	#txtBoxProd{
		font-family: 'Poppins', sans-serif;
		color:#888;
		font-size:15px;		
	}

	#txtBoxProd1{
		font-family: 'Poppins', sans-serif;
		color:#222;
		font-size:15px;
		margin-top:16px;
	}

	#bntComprar{
		height: 48px;
		margin-top:20px;
	}

</style>

</head>
<body>
    <?php 
	session_start();

    include 'conexao.php';
    include 'nav.php';
    include 'cabecalho.html';
	
	$consulta = $cn->query("select cod_Roupa, nome_Roupa, valor_Roupa, qtn_estoque, desc_imagem from vw_Roupa where Roupa_lancamento = 'S'");
	?>
	
	<div class="container-fluid">
	    <div class="row">
		<?php while($exibe = $consulta->fetch(PDO::FETCH_ASSOC)){ ?>
			<div class="col-sm-3" id="boxProd">
			    <img src="img/<?php echo $exibe['desc_imagem']; ?>.jpg" class= "img-responsive" id="imgPord">
				<div class="text-center"><a id="txtBoxProd" href="detalhes.php?cod=<?php echo $exibe ['cod_Roupa']; ?>"><?php echo mb_strimwidth ($exibe['nome_Roupa'],0,36,'...'); ?></a></div>
				<div class="text-center"><h5 id="txtBoxProd1">R$ <?php echo number_format ($exibe['valor_Roupa'],2,',','.'); ?></h5></div>
			
				<div class="text-center" style="margin-top:5px; margin-bottom:5px">
				    <?php if($exibe['qtn_estoque'] > 0) { ?>
				
				    <button class="btn btn-block btn-info" id="bntComprar">
					    <span> Comprar </span>
					</button>
					
					<?php } else { ?>
					<button class="btn btn-block btn-danger" disabled>
					    <span class="glyphicon glyphicon-remove-circle"> Indisponivel </span>
					</button>
					
					<?php } ?>
			    </div>
			</div>
		<?php } ?>
		</div>
	</div>
	
	<?php include 'footer.html' ?>
</body>
</html>