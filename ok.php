<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Minha Loja - Login de usuário</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
}

.btn {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    background-color: #000000; /* Cor preto */
    color: white;
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    transition: all 0.3s ease;
	
}

.btn-block{
	margin-bottom: 50%;
}

.btn:hover {
    background-color: #000000; 
    color: white;
    transform: scale(1.05); /* Pequeno efeito de zoom */
}
</style>
</head>
<body>

<?php include 'conexao.php'; include 'nav.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4 text-center">
            <h2>Usuário Cadastrado com Sucesso!</h2>			
            <a href="formlogon.php" class="btn btn-block" role="button">Voltar para a Loja</a>			
        </div>
    </div>
</div>

<?php include 'footer.html'; ?>

</body>
</html>
