<?php
    require_once "../conexao.php";
    require_once "../verificar_user.php";

if (isset($_SESSION['tipo'])) {
    if (isset($_GET['id'])) {

        $id = $_GET['id'];

            if ($_SESSION['tipo'] == "comum") {

                $sql = "SELECT * FROM usuario WHERE usuario_id = ?";
                $comando = mysqli_prepare($conexao, $sql);
        
                mysqli_stmt_bind_param($comando, 'i', $id);
                mysqli_stmt_execute($comando);
        
                $resultados = mysqli_stmt_get_result($comando);
        
                $autor = mysqli_fetch_assoc($resultados);
        
                $nome = $autor['usuario_nome'];
                $nascimento = $autor['usuario_data_nasc'];
                $nick = $autor['usuario_nick'];
                $foto = $autor['usuario_foto'];
        }
        else {  
            header("Location: ../index.php");
        }
    }
    else {
        
        $id = 0;
        $nome = "";
        $nascimento = "";
        $nick = "";
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
    <title>Editar perfil</title>
</head>
<body>
    <a href="../index.php" target="_top">Voltar</a> <br><br>

<form action="salvar.php" method="POST" enctype="multipart/form-data">

Nome completo: <br>
<input type="text" name="nome" required value="<?php echo $nome ?>"> <br><br>

Data de Nascimento: <br>
<input type="date" name="data_nasc" required value="<?php echo $nascimento ?>"> <br><br>

Nickname: <br>
<input type="text" name="nick" required value="<?php echo $nick ?>"> <br><br>

Foto de perfil: <br>
<input type="file" name="foto">
<br><br>

<input type="submit" value="Salvar perfil"> 

<br><br>

Listagem de Resenhistas: <br>
<a href="listar.php">Confira a listagem de usuários já cadastrados!</a>

<?php
require_once "../erro_login.php"
?>

</form>
</body>
</html>