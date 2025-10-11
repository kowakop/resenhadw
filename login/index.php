<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="saida.php" method='POST'>

    Nome de usuário ou E-mail: <br>
    <input type="text" name="nome" required>
    <br><br>

    Senha:
    <br>
    <input type="password" name="senha" required><br>
    <input type="checkbox" name="" id="mostrar_senha"><span>mostra senha</span> 
    <br><br>

    <?php
    require_once "../erro_login.php"
    ?>

    <br><br>
    <input type="submit" value="Logar">
    
    </form>

</body>
</html>