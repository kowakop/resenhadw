<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
    <style>

    </style>
</head>
<body id="login">

    <div class="container_login">
        <div class="form-section">
            <h2>Log in</h2>

            <form action="saida.php" method="POST">
                Nome de usuário ou E-mail:
                <input type="text" name="nick" id="nick" required>

                Senha:
                <input type="password" name="senha" id="senha" required>

                <div class="show-password">
                    <input type="checkbox" id="mostrar_senha">
                    <span>mostrar senha</span>
                </div>

                <?php require_once "../erro_login.php"; ?>

                <input type="submit" value="Logar" id="submeter">

                <div class="register">
                    Não possui uma conta? <a href="../cadastro/index.php">Cadastre-se</a>
                </div>
            </form>
        </div>

        <div class="image-section">
            <p>Seja bem-vindo(a) de volta!</p>
            <img src="https://i.pinimg.com/originals/fd/63/54/fd6354941999e219a0424f727530a274.gif">
        </div>
    </div>

    <script>
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
