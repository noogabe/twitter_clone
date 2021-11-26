<?php
	require_once('db.class.php');

	$usuario = $_POST['usuario'];
	$email = $_POST['email'];
	$senha = md5($_POST['senha']);

	$objDB = new DB();
	$link = $objDB->conecta_mysql();

	$usuario_existe = false;
	$email_existe = false;

	/* Verificar se usuario ja existe */
	$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
	if($resultado_verifica = mysqli_query($link, $sql)){

		$dados_usuario = mysqli_fetch_array($resultado_verifica);
		if(isset($dados_usuario['usuario'])){
			$usuario_existe = true;
		} 
	} else {
		echo 'Erro ao tentar localizar usuario!';
	}

	/* Verificar se email ja existe */
	$sql = "SELECT * FROM usuarios WHERE email = '$email'";
	if($resultado_verifica = mysqli_query($link, $sql)){

		$dados_usuario = mysqli_fetch_array($resultado_verifica);
		if(isset($dados_usuario['usuario'])){
			$email_existe = true;
		} 
	} else {
		echo 'Erro ao tentar localizar email!';
	}

	if($usuario_existe || $email_existe){

		$retorno_get = '';

		if($usuario_existe){
			$retorno_get .= "erro_usuario=1&";
		}

		if($email_existe){
			$retorno_get .= "erro_email=1&";
		}

		header('Location: inscrevase.php?' . $retorno_get);
		die();
	}


	/* Inserir no banco */
	$sql = "INSERT INTO usuarios (usuario, email, senha) VALUES ('$usuario', '$email', '$senha')";

	$insert = mysqli_query($link, $sql);

	if($insert){
		echo("<script>alert('Usuário registrado com sucesso!')
		window.location.href='../twitter_clone/inscrevase.php';</script>");
	} else{
		echo("<script>alert('Erro ao registrar usuário!')
		window.location.href='../twitter_clone/inscrevase.php';</script>");
	}
?>