<?php
require_once "../conexao.php";
require_once "../verificar_user.php";
if ($_SESSION['tipo'] == "admin") {
} else {
    header("Location: ../index.php");
}
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if (isset($_SESSION['tipo'])) {
        if ($_SESSION['tipo'] == "admin" || $_SESSION['id'] == $id) {


            $sql = "SELECT * FROM obra WHERE obra_id = ?";
            $comando = mysqli_prepare($conexao, $sql);

            mysqli_stmt_bind_param($comando, 'i', $id);
            mysqli_stmt_execute($comando);

            $resultados = mysqli_stmt_get_result($comando);

            $obra = mysqli_fetch_assoc($resultados);

            $nome = $obra['obra_nome'];
            $inicio = $obra['obra_data_inicio'];
            $final = $obra['obra_data_final'];
            $capitulo = $obra['obra_qtd_capitulos'];
            $volume = $obra['obra_qtd_volumes'];
            $autor_id = $obra['obra_autor_id'];
        }
    }
} else {

    $id = 0;
    $nome = "";
    $inicio = "";
    $final = "";
    $capitulo = "";
    $volume = "";
    $autor_id = "";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar obra</title>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
</head>

<body>

    <form action="salvar.php" method="post" enctype="multipart/form-data">

        Nome da obra: <br>
        <input type="text" name="nome" required value="<?php echo $nome ?>"> <br><br>

        Data de Início: <br>
        <input type="date" name="inicio" required value="<?php echo $inicio ?>"> <br><br>

        Data de Término: <br>
        <input type="date" name="final" value="<?php echo $final ?>"> <br><br>

        Quantidade de Capítulos: <br>
        <input type="number" name="qtd_cap" required value="<?php echo $capitulo ?>"> <br><br>

        Quantidade de Volumes: <br>
        <input type="number" name="qtd_vol" required value="<?php echo $volume ?>"> <br><br>
        Autor: <br>
        <select name="autor" required>
            <?php
            $sql = "SELECT * FROM autor";

            $comando = mysqli_prepare($conexao, $sql);
            mysqli_stmt_execute($comando);
            $resultados = mysqli_stmt_get_result($comando);

            while ($autor = mysqli_fetch_assoc($resultados)) {
                $nome = $autor['autor_nome'];
                $id_autor = $autor['autor_id'];

                echo "<option value='$id_autor'";
                if ($id_autor == $autor_id) {
                    echo "selected";
                }
                echo ">$nome</option>";
            }
            ?>
        </select> <br><br>

        foto:<input type="file" name="foto" id=""> <br><br>

        <input type="submit" value="Salvar Obra">

    </form>
</body>
</html>