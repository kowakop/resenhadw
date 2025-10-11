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