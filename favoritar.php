<?php
    require_once "./conexao.php";

    session_start();
    if (!isset($_SESSION['id'])) {
        header('Location: ./login/index.php');
    } else {
        $id = $_SESSION['id'];
        $nome = $_SESSION['nick'];
        $tipo = $_SESSION['tipo'];
    }


    


?>
