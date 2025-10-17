<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Lista de alunos Cadastrados</h2>
    <a href="index.php">Voltar</a>
    <?php
    require_once "../conexao.php";
    require_once "../verificar_user.php";
    $sql = "SELECT obra_id, obra_nome, obra_data_inicio, obra_data_final, obra_qtd_capitulos, obra_qtd_volumes, obra_autor_id FROM obra";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);

    echo "<table border='1'>";
    echo "<tr>";
    echo "<td>ID</td>";
    echo "<td>Nome da Obra</td>";
    echo '<td>Data de Inicio</td>';
    echo '<td>Data da Finalização</td>';
    echo '<td>Quantidade de Capitulos</td>';
    echo '<td>Quantidade de Volumes</td>';
    echo '<td>Nome do Autor</td>';
    echo '</tr>';

    while ($obras= mysqli_fetch_assoc($resultados)) {
        $obra_id = $obras['obra_id'];
        $obra_nome = $obras['obra_nome'];
        $obra_data_inicio= $obras['obra_data_inicio'];
        $obra_data_final = $obras['obra_data_final'];
        $obra_qtd_capitulos = $obras['obra_qtd_capitulos'];
        $obra_qtd_volumes = $obras['obra_qtd_volumes'];
        $obra_autor_id= $obras['obra_autor_id'];
    
        echo '<tr>';
        echo "<td>$obra_id </td>";
        echo "<td>$obra_nome </td>";
        echo "<td>$obra_data_inicio</td>";
        echo "<td>$obra_data_final</td>";
        echo "<td>$obra_qtd_capitulos</td>";
        echo "<td>$obra_qtd_volumes</td>";
        echo "<td>$obra_autor_id</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_stmt_close($comando)  
    ?>
</body>
</html>