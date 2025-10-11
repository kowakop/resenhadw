<?php
    require_once "../conexao.php";
    session_start();
    
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    
    $nome = trim($nome);
    $senha = trim($senha);

    if ($nome == "" || $senha == "") {
        "*Você precisa preencher todos os campos";
        header("Location: index.php?e=1");
    }

    $sql = "SELECT * FROM usuario WHERE usuario_nome = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "s", $nome);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $bd_dados = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($comando);

    if ($bd_dados == NULL) {
        $sql = "SELECT * FROM usuario WHERE usuario_email = ?";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($comando, "s", $nome);

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
    $_SESSION["nome"] = $nome;
    $_SESSION['id'] = $bd_dados['id'];

    header("Location: ../index.php");
    
?>