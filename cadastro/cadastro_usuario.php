<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>
<body>
<form action="saida.php" method='POST'>

    Nome: <br>
    <input type="text" name="nome">
    <br><br>

    <!-- teste git -->
    Data de nascimento:
    <br>
    <input type="date" name="data">
    <br><br>

    E-mail:
    <br>
    <input type="text" name="email" placeholder="exemplo@gmail.com">
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