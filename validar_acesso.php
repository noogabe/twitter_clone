<?php

    session_start();

    require_once('db.class.php');

    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']);

    $objDB = new DB();
	$link = $objDB->conecta_mysql();

    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";

    $retorno = mysqli_query($link, $sql);

    if($retorno){

        $dados_usuario = mysqli_fetch_array($retorno);
        
        if(isset($dados_usuario['usuario'])){

            $_SESSION['usuario'] = $dados_usuario['usuario'];
            $_SESSION['email'] = $dados_usuario['email'];

            header('Location: home.php');

        } else {
            header('Location: index.php?erro=1');
        }

    } else {
        echo 'Erro na execução da consulta, favor entrar em contato com o admin do site!';
    }

    ?>