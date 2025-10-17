<?php
    require_once "../conexao.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autor</title>
</head>
<body>

<a href="index.php">Voltar</a> <br><br>

<form action="salvar.php" method="POST" enctype="multipart/form-data">

Nome do Autor: <br>
<input type="text" name="nome" required> <br><br>

Data de Nascimento: <br>
<input type="date" name="data_nasc"> <br><br>

O autor já morreu? <br>
<input type="radio" name="opcao" id="" value="sim"> Sim <br>
<input type="radio" name="opcao" id="" value="nao">não <br><br>

Data da morte: <br>
<input type="date" name="data_morte"> <br><br>

Foto do autor: <br>
<input type="file" name="foto">
<br><br>

<input type="submit" value="Salvar dados do Autor"> 

<br><br>

Listagem de Autores: <br>
<a href="listar.php">Listagem</a>

<?php
require_once "../erro_login.php"
?>

</form>
</html>