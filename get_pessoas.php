<?php

    session_start();

    if(!isset($_SESSION['usuario'])){
        header('Location: index.php?erro=2');
    }

    require_once('db.class.php');

    $id_usuario = $_SESSION['id_usuario'];
    $nome_pessoa = $_POST['nome_pessoa'];

    $objDB = new DB();
    $link = $objDB->conecta_mysql();

    /* Select em todos os usuarios com esse nome, menos o meu */
    $sql = "SELECT * FROM usuarios WHERE usuario LIKE '%$nome_pessoa%' AND id <> $id_usuario";

    $resultado = mysqli_query($link, $sql);

    if($resultado){
        
        while($registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
            echo 
                "<a href='#' class='list-group-item'>
                    <strong>".$registro['usuario']."</strong> <small> - ".$registro['email']." - </small>
                    <p class='list-group-item-text pull-right'>
                        <button type='button' class='btn btn-default'>Seguir</button>
                    </p>
                    <div class='clearfix'></div>
                </a>";
        }

    } else {
        echo "Erro na consulta de usuarios no banco de dados!";
    }

?>