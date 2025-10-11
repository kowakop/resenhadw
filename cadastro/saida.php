<?php

    require_once "../conexao.php";

    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $nome = trim($nome);
    $email = trim($email);
    $senha = trim($senha);
    $nascimento = trim($nascimento);

    if (strlen($email) > 40) {
        header("Location: index.php");
    }
    
    if (strlen($nome) > 14) {
        header("Location: index.php");
    }
    
    if (strlen($senha) > 30) {
        header("Location: index.php");
    }
    
    if ($nome == "" || $email == "" || $senha == "" || $nascimento == "") {
        header("Location: index.php");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php");
    }

    $nome_arquivo = $_FILES['foto']['name'];
    $caminho_temporario = $_FILES['foto']['tmp_name'];

    //pegar a extensão do arquivo
    $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);

    //gerar um novo nome
    $novo_nome = uniqid() . "." . $extensao;

    // lembre-se de criar a pasta e de ajustar as permissões.
    $caminho_destino = "../fotos/" . $novo_nome;

    // move a foto para o servidor
    move_uploaded_file($caminho_temporario, $caminho_destino);


    $sql = "INSERT INTO usuario (usuario_nome, usuario_data_nasc, usuario_email, usuario_senha, usuario_foto) 
    VALUES (?, ?, ?, ?, ?)";

    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'sssss', $nome, $nascimento, $email, $senha, $novo_nome);

    mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);

    header("Location: index.php");

?>