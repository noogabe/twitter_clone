<?php
    session_start();

    if(!isset($_SESSION['usuario'])){
        header('Location: index.php?erro=2');
    }

    require_once('db.class.php');

    $texto_tweet = $_POST['texto_tweet'];
    $id_usuario = $_SESSION['id_usuario'];

    if($texto_tweet != '' || $id_usuario != ''){
        $objDB = new DB();
        $link = $objDB->conecta_mysql();

        $sql = "INSERT INTO tweets (id_usuario, tweet) VALUES ($id_usuario, '$texto_tweet')";

        mysqli_query($link, $sql);
    }

?>