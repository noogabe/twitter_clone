<?php
    session_start();

    if(!isset($_SESSION['usuario'])){
        header('Location: index.php?erro=2');
    }

	require_once('db.class.php');

	$objDB = new DB();
    $link = $objDB->conecta_mysql();
	
	$id_usuario = $_SESSION['id_usuario'];

	/* Recuperar qtd tweets */
	$sql = "SELECT COUNT(*) AS qtde_tweets FROM tweets WHERE id_usuario = $id_usuario";
	$resultado = mysqli_query($link, $sql);
	$qtde_tweets = 0;

	if($resultado){
        
        $registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC);		 
		$qtde_tweets = $registro['qtde_tweets'];

    } else {
        echo "Erro na consulta de registros no banco de dados!";
    }
	/* Recuperar qtd seguidores */
	$sql = "SELECT COUNT(*) AS qtde_seguidores FROM usuarios_seguidores
			WHERE seguindo_id_usuario = $id_usuario";
	$resultado = mysqli_query($link, $sql);
	$qtde_seguidores = 0;

	if($resultado){
        
        $registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC);		 
		$qtde_seguidores = $registro['qtde_seguidores'];

    } else {
        echo "Erro na consulta de registros no banco de dados!";
    }

?>

<!DOCTYPE HTML>
<html lang="pt-br">

<head>

	<meta charset="UTF-8">

	<title>Twitter clone</title>

	<!-- jquery - link cdn -->
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

	<!-- bootstrap - link cdn -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	<script type="text/javascript">

		$(document).ready(function(){
			/* Associar evento de clique ao botao tweet */
			$("#btn_tweet").click(function(){
				
				if($("#texto_tweet").val().length > 0){
					$.ajax({
						url: 'inclui_tweet.php',
						method: 'post',
						data: $("#form-tweet").serialize(),
						success: function(data){
							$("#texto_tweet").val('');
							atualizaTweet();
						}
					});
				}
			});

			function atualizaTweet(){
				/* Carregar tweets */
				$.ajax({
					url: 'get_tweet.php',
					success: function(data) {
						$("#tweets").html(data);
					}
				});
			}

			atualizaTweet();
		});

	</script>
</head>

<body>

	<!-- Static navbar -->
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<img src="imagens/icone_twitter.png" />
			</div>

			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="sair.php">Sair</a></li>
				</ul>
			</div>
		</div>
	</nav>


	<div class="container">
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body">
					<h4><?=  $_SESSION['usuario']; ?></h4>
					<hr>
					<div class="col-md-6">
						TWEETS <br> <?= $qtde_tweets ?>
					</div>
					<div class="col-md-6">
						SEGUIDORES <br> <?= $qtde_seguidores ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
					<form id="form-tweet" class="input-group">
						<input type="text" id="texto_tweet" name="texto_tweet" class="form-control" placeholder="O que está acontecendo agora?" maxlength="140">
						<span class="input-group-btn">
							<button class="btn btn-default" id="btn_tweet" type="button">Tweet</button>
						</span>
					</form>
				</div>	
			</div>
			<div id="tweets" class="list-group">

			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body">
					<h4><a href="procurar_pessoas.php">Procurar por pessoas</a></h4>
				</div>
			</div>
		</div>
	</div>


	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>

</html>