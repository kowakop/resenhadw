<?php
session_start();

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if (isset($_SESSION['tipo'])) {
        if ($_SESSION['tipo'] == "admin" || $_SESSION['id'] == $id) {
            require_once "conexao.php";

            $sql = "SELECT * FROM usuario WHERE usuario_id = ?";
            $comando = mysqli_prepare($conexao, $sql);
    
            mysqli_stmt_bind_param($comando, 'i', $id);
            mysqli_stmt_execute($comando);
    
            $resultados = mysqli_stmt_get_result($comando);
    
            $usuario = mysqli_fetch_assoc($resultados);
    
            $nick = $usuario['usuario_nick'];
            $nome = $usuario['usuario_nome'];
            $nascimento = $usuario['usuario_data_nasc'];
            $email = $usuario['usuario_email'];
            $senha = $usuario['usuario_senha'];
        }

    }
}
else {
    
    $id = 0;
    $nick = "";
    $nome = "";
    $email = "";
    $nascimento = "";
    $senha = "";
}

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>
<body>
<form action="saida.php" method='POST' enctype="multipart/form-data">
    Nickname:<br>
    <input type="text" name="nick" required placeholder='Nome único'>
    <br><br> 

    Nome: <br>
    <input type="text" name="nome" required placeholder='Seu nome'>
    <br><br>

    <!-- teste git -->
    Data de nascimento:
    <br>
    <input type="date" name="nascimento" required>
    <br><br>

    E-mail:
    <br>
    <input type="text" name="email" placeholder="Informe o seu Email" required>
    <br><br>
    
    Digite sua senha:
    <br>
    
    <input type="text" name="senha" required>
    <br><br>
    
    Selecione sua foto de perfil:
    <br>
    <input type="file" name="foto">

    <br><br>

    <input type="submit" value="Salvar">
    <br><br>


    <?php
    require_once "../erro_login.php"
    ?>
    </form>
</body>
</html>