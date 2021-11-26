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
    $sql = "SELECT u.*, us.*
            FROM usuarios AS u
            LEFT JOIN usuarios_seguidores AS us
            ON (us.id_usuario = '$id_usuario' AND u.id = us.seguindo_id_usuario)
            WHERE u.usuario LIKE '%$nome_pessoa%' AND u.id <> $id_usuario";

    $resultado = mysqli_query($link, $sql);

    if($resultado){
        
        while($registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
            echo 
                "<a href='#' class='list-group-item'>
                    <strong>".$registro['usuario']."</strong> <small> - ".$registro['email']." </small>
                    <p class='list-group-item-text pull-right'>";

                    $esta_seguindo = isset($registro['id_usuario_seguidor']) && !empty($registro['id_usuario_seguidor']) ? 'S' : 'N';

                    $seguir_display = 'block';
                    $deixar_seguir_display = 'block';

                    if($esta_seguindo == 'N'){
                        $deixar_seguir_display = 'none';
            
                    } else if($esta_seguindo == 'S') {
                        $seguir_display = 'none';
                    }

                    echo"<button type='button' id='btn_seguir_".$registro['id']."' style='display:".$seguir_display.";' class='btn btn-default btn_seguir' data-id_usuario=".$registro['id'].">Seguir</button>
                        <button type='button' id='btn_deixar_seguir_".$registro['id']."' style='display:".$deixar_seguir_display.";' class='btn btn-primary btn_deixar_seguir' data-id_usuario=".$registro['id'].">Deixar de Seguir</button>
                    </p>
                    <div class='clearfix'></div>
                </a>";
        }

    } else {
        echo "Erro na consulta de usuarios no banco de dados!";
    }

?>