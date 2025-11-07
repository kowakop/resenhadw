<?php
session_start();

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if (isset($_SESSION['tipo'])) {
        if ($_SESSION['tipo'] == "admin" || $_SESSION['id'] == $id) {
            require_once "../conexao.php";

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
    <link rel="shortcut icon" href="../favicon.ico"
    type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
</head>
<body id="cadastro">

    <div class="container_cadastro">
        <div class="form-section">
            <form action="saida.php?id=<?php echo $id; ?>" method='POST' enctype="multipart/form-data">

            <h2>Aréa de Cadastro</h2>

            Nickname:
            <input type="text" name="nick" id="nick" placeholder='Nome único' 
                   value="<?php echo $nick; ?>">

            Nome:
            <input type="text" name="nome" id="nome" required placeholder='Seu nome'
                   value="<?php echo $nome; ?>">

            Data de nascimento:

            <input type="date" name="nascimento" id="nascimento" 
                   value="<?php echo $nascimento; ?>">

            E-mail:

            <input type="text" name="email" id="email" placeholder="Informe o seu Email" required 
                   value="<?php echo $email; ?>">
    
            Digite sua senha:

            <input type="password" name="senha" id="senha" required 
                   value="<?php echo $senha; ?>"> 
            <input type="checkbox" id="mostrar_senha"><span>mostra senha</span> 

            <?php 
            if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == "admin") {
                echo "
                Tipo de usuário:   
                <select name='tipo' id=''>
                    <option value='comum'>Comum</option>
                    <option value='admin'>Admin</option>
                </select> <br> <br>
                ";
            }
            ?>
    
            Selecione sua foto de perfil:

            <input type="file" name="foto">

            <input type="submit" value="Salvar" id="submeter">



            <?php
            require_once "../erro_login.php";
            ?>
            </div>
        </form>
    </div>


    <script> 
         // puxa os elementos por id
         const senhaInput = document.getElementById('senha');
        const mostrarSenhaCheckbox = document.getElementById('mostrar_senha');

        // Adiciona um evento de clique na checkbox
        mostrarSenhaCheckbox.addEventListener('click', function() {
            if (mostrarSenhaCheckbox.checked) {
                // Se a checkbox estiver marcada, mostra a senha
                senhaInput.type = 'text';
            } else {
                // Se a checkbox estiver desmarcada, oculta a senha
                senhaInput.type = 'password';
            }
        });
    </script>
</body>
</html>