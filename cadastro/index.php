<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>
<body>
<form action="saida.php" method='POST' enctype="multipart/form-data">

    Username: <br>
    <input type="text" name="nome">
    <br><br>

    <!-- teste git -->
    Data de nascimento:
    <br>
    <input type="date" name="nascimento">
    <br><br>

    E-mail:
    <br>
    <input type="text" name="email" placeholder="Informe o seu Email">
    <br><br>
    
    Digite sua senha:
    <br>
    
    <input type="text" name="senha">
    <br><br>
    
    Selecione sua foto de perfil:
    <br>
    <input type="file" name="foto">

<br><br>

    <input type="submit" value="Salvar">
    </form>
</body>
</html>