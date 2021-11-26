<?php

    session_start();

    if(!isset($_SESSION['usuario'])){
        header('Location: index.php?erro=2');
    }

    require_once('db.class.php');

    $id_usuario = $_SESSION['id_usuario'];

    $objDB = new DB();
    $link = $objDB->conecta_mysql();

    $sql = "SELECT DATE_FORMAT(t.data_inclusao, '%d %b %Y %T') as data_inclusao_formatada, t.tweet, u.usuario
            FROM tweets AS t JOIN usuarios AS u ON (u.id = t.id_usuario)
            WHERE id_usuario = $id_usuario ORDER BY data_inclusao DESC";

    $resultado = mysqli_query($link, $sql);

    if($resultado){
        
        while($registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
            echo 
                "<a href='#' class='list-group-item'>
                    <h4 class='list-group-item-heading'>" . $registro['usuario'] . "<small> - ". $registro['data_inclusao_formatada'] ."</small></h4>
                    <p class='list-group-item-text'>" . $registro['tweet'] . "</p>
                </a>";
        }

    } else {
        echo "Erro na consulta de tweets no banco de dados!";
    }

?>