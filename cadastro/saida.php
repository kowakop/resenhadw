<?php

    require_once "../conexao.php";
    $nome = $_POST['nome'];
    $nick = $_POST['nick'];
    $nascimento = $_POST['nascimento'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $nome = trim($nome);
    $nick = trim($nick);
    $email = trim($email);
    $senha = trim($senha);
    $nascimento = trim($nascimento);

    $tempo = strtotime($nascimento);
    $hoje = time();

    if ($nick == "" || $email == "" || $senha == "" || $nascimento == "" || $nick == "") {
        header("Location: index.php?e=1");
    }
    
    if (strlen($nick) > 22) {
        header("Location: index.php?e=2");
    }
    
    if (strlen($senha) > 30) {
        header("Location: index.php?e=3");
    }
    
    if (strlen($email) > 254) {
        header("Location: index.php?e=4");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?e=5");
    }

    if ($tempo === false) {
        header("Location: index.php?e=6");
    } 

    elseif ($tempo > $hoje) {
        header("Location: index.php?e=7");
    } 
    
    elseif ($tempo < strtotime("1901-01-01")) {
        header("Location: index.php?e=8");
    }

    elseif (strlen($nome) > 70){
        header("Location: index.php?e=14");
    }

    $sql = "SELECT usuario_id FROM usuario WHERE usuario_nick = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "s", $nick);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $bd_dados = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($comando);

    if ($bd_dados) {
        header("Location: index.php?e=12");
    } 

    $sql = "SELECT usuario_id FROM usuario WHERE usuario_email = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "s", $email);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $bd_dados = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($comando);

    if ($bd_dados) {
        header("Location: index.php?e=13");
    } 

    $nome_arquivo = $_FILES['foto']['name'];
    $caminho_temporario = $_FILES['foto']['tmp_name'];

    //pegar a extensão do arquivo
    $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);

    //gerar um novo nome
    $novo_nome = uniqid() . "." . $extensao;

    // lembre-se de criar a pasta e de ajustar as permissões.
    $caminho_destino = "../fotos/" . $novo_nome;

    // move a foto para o
    move_uploaded_file($caminho_temporario, $caminho_destino);


    $sql = "INSERT INTO usuario (usuario_nome, usuario_data_nasc, usuario_email, usuario_senha, usuario_foto, usuario_nick) 
    VALUES (?, ?, ?, ?, ?, ?)";

    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ssssss', $nome, $nascimento, $email, $senha, $novo_nome, $nick);

    mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);

    header("Location: index.php");

?>