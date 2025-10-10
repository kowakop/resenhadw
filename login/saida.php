<?php
    require_once "../conexao.php";
    session_start();
    
    $nome = $_POST['username'];
    $senha = $_POST['senha'];
    
    $nome = trim($nome)
    $senha = trim($nome)

    if ($nome == "" || $senha == "") {
        $_SESSION["erro"] = "*Você precisa preencher todos os campos";
        header("Location: login.php");
        exit();
    }

    $sql = "SELECT * FROM usuario WHERE usuario_nome = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param();
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $bd_dados = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($comando);

    if ($bd_dados == NULL) {
        $sql = "SELECT * FROM usuario WHERE email = ?";
        $comando = mysqli_prepare($conexao, $sql);

        mysqli_stmt_execute($comando);
        $resultado = mysqli_stmt_get_result($comando);
        mysqli_stmt_bind_param();

        $bd_dados = mysqli_fetch_assoc($resultado);
        mysqli_stmt_close($comando);
    
        if ($bd_dados == NULL) {
            $_SESSION["erro"] = "*Usuário inexistente";
            header("Location: login.php");
            exit();
        }
    }

    if ($bd_dados["senha"] != $senha) {
        $_SESSION["erro"] = "*Senha incorreta";
        header("Location: login.php");
        exit();
    }



    $_SESSION["logado"] = True;
    $_SESSION["nome"] = $nome;
    $_SESSION['id'] = $bd_dados['id'];

    header("Location: ../index.php");
    exit();
    
?>