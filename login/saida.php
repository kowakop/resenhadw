<?php
    require_once "../conexao.php";
    session_start();
    
    $nick = $_POST['nick'];
    $senha = $_POST['senha'];
    
    $nick = trim($nick);
    $senha = trim($senha);

    if ($nick == "" || $senha == "") {
        "*Você precisa preencher todos os campos";
        header("Location: index.php?e=1");
    }

    $sql = "SELECT * FROM usuario WHERE usuario_nick = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "s", $nick);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $bd_dados = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($comando);

    if ($bd_dados == NULL) {
        $sql = "SELECT * FROM usuario WHERE usuario_email = ?";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($comando, "s", $nick);

        mysqli_stmt_execute($comando);
        $resultado = mysqli_stmt_get_result($comando);

        $bd_dados = mysqli_fetch_assoc($resultado);
        mysqli_stmt_close($comando);
    
        if ($bd_dados == NULL) {
            
            header("Location: index.php?e=10");
        }
    }

    if ($bd_dados["usuario_senha"] != $senha) {
        "*Senha incorreta";
        header("Location: index.php?e=11");
    }

    

    $_SESSION["tipo"] = $bd_dados['usuario_tipo'];
    $_SESSION["logado"] = True;
    $_SESSION["nick"] = $nick;
    $_SESSION['id'] = $bd_dados['usuario_id'];

    header("Location: ../index.php");
    
?>