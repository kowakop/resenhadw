<?php
    require_once "../conexao.php";
    require_once "../verificar_user.php";

if (isset($_SESSION['tipo'])) {
    if (isset($_GET['id'])) {

        $id = $_GET['id'];

            if ($_SESSION['tipo'] == "admin") {

                $sql = "SELECT * FROM autor WHERE autor_id = ?";
                $comando = mysqli_prepare($conexao, $sql);
        
                mysqli_stmt_bind_param($comando, 'i', $id);
                mysqli_stmt_execute($comando);
        
                $resultados = mysqli_stmt_get_result($comando);
        
                $autor = mysqli_fetch_assoc($resultados);
        
                $nome = $autor['autor_nome'];
                $nascimento = $autor['autor_data_nasc'];
                $morte = $autor['autor_data_morte'];
                $foto = $autor['autor_foto'];
        }
        else {  
            header("Location: ../index.php");
        }
    }
    else {
        
        $id = 0;
        $nome = "";
        $nascimento = "";
        $morte = "";
        $foto= "";
    }
}
else {
    header("Location: ../index.php");}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Autor</title>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
</head>
<body>

<a href="../index.php" target="_top">Voltar</a> <br><br>

<form action="salvar.php" method="POST" enctype="multipart/form-data">

Nome do Autor: <br>
<input type="text" name="nome" required value="<?php echo $nome ?>"> <br><br>

Data de Nascimento: <br>
<input type="date" name="data_nasc" required value="<?php echo $nascimento ?>"> <br><br>

O autor já morreu? <br>
<input type="radio" name="opcao" value="sim" <?php if ($morte != "" && $morte != null) echo "checked"; ?>> Sim
<input type="radio" name="opcao" value="nao" <?php if ($morte != "" && $morte == null) echo "checked"; ?>> Não
<br><br>

Data da morte: <br>Editar
<input type="date" name="data_morte" value="<?php echo $morte ?>"> <br><br>

Foto do autor: <br>
<input type="file" name="foto">
<br><br>

<input type="submit" value="Salvar dados do Autor"> 

<br><br>

Listagem de Autores: <br>
<a href="listar.php">Confira a listagem de autores já cadastrados!</a>

<?php
require_once "../erro_login.php"
?>

</form>
</body>
</html>