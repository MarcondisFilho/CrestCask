<!DOCTYPE HTML>
<html lang="pt-br">
<head>
<title>Login do usuário</title>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	
<style>

.navbar{
	margin-bottom: 0;
}
	
.row{
	margin-top:5%;
	margin-bottom:5%;
}

.login-form {
	background: #ffffff;
	padding: 30px;
	border-radius: 10px;
	box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.login-form h2 {
	font-weight: 600;
	color: #333;
	margin-bottom: 30px;
}

.form-group label {
	font-weight: 500;
}

.btn-info {
	background-color: #17a2b8;
	border: none;
	border-radius: 5px;
	font-weight: 600;
	padding: 10px 20px;
	width: 100%;
	transition: background-color 0.3s ease;
}

.btn-info:hover {
	background-color: #138496;
}

.btn-link {
	font-weight: 600;
	text-decoration: none;
	color: #007bff;
	display: inline-block;
	margin-top: 15px;
	transition: color 0.3s ease;
}

.btn-link:hover {
	color: #0056b3;
	
}
	
</style>
	
</head>
<body>

<?php
	
	include 'conexao.php';	
	include 'nav.php';
	?>
	
	
	<div class="container-fluid">
		<div class="row">	
			<div class="col-sm-4 col-sm-offset-4">
				
				<h2 class="text-center">Login de Usuário</h2>
				<form name="frmusuario" method="post" action="validausuario.php">
				
					<div class="form-group">
						<label for="email">Email</label>
						<input name="txtemail" type="email" class="form-control" required id="email">
					</div>
				
					<div class="form-group">				
						<label for="senha">Senha</label>
						<input name="txtsenha" type="password" class="form-control" required id="senha">
					</div>
								
				<button type="submit" class="btn btn-lg btn-info">Entrar</button>
				
				<a href="formusuario.php">
					<button type="button" class="btn btn-lg btn-link">Ainda não sou cadastrado</button>
				</a>
				</form>			
			</div>
		</div>
	</div>
	
	<?php include 'footer.html' ?>
</body>
</html>