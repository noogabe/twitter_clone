<?php
	require_once('db.class.php');

	$usuario = $_POST['usuario'];
	$email = $_POST['email'];
	$senha = md5($_POST['senha']);

	$objDB = new DB();
	$link = $objDB->conecta_mysql();

	$sql = "INSERT INTO usuarios (usuario, email, senha) VALUES ('$usuario', '$email', '$senha')";

	//executar query
	$insert = mysqli_query($link, $sql);

	if($insert){
		echo("<script>alert('Usuário registrado com sucesso!')
		window.location.href='../twitter_clone/inscrevase.php';</script>");
	} else{
		echo("<script>alert('Erro ao registrar usuário!')
		window.location.href='../twitter_clone/inscrevase.php';</script>");
	}
?>