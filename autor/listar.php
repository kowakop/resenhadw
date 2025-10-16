<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Autores</title>
</head>
<body>
    <h2>Lista de Autores</h2>

    <a href="index.php">Voltar</a> <br>
    <?php

        require_once "conexao.php";

        $sql = "SELECT * from autor";
        $comando = mysqli_prepare($conexao, $sql);

        mysqli_stmt_execute($comando);

        $resultados = mysqli_stmt_get_result($comando);

        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>ID</td>";
        echo "<td>Nome</td>";
        echo "<td>Data de Nascimento</td>";
        echo "<td>Data de Morte</td>";
        echo "<td>Foto</td>";
        echo "<td>AÇÃO</td>";
        echo "</tr>";

        while ($autor = mysqli_fetch_assoc($resultados)) {
            $id = $autor['id_autor'];
            $nome = $autor['nome'];
            $data_nasc = $autor['data_nasc'];
            $data_morte = $autor['data_morte'];

            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$nome</td>";
            echo "<td>$data_nasc</td>";
            echo "<td>$data_morte</td>";
            
            echo "<td><a href='form_autor.php?id=$id'>editar</a></td>";
            echo "</tr>";
        }
        echo "</table>";

        mysqli_stmt_close($comando);    
    ?>
</body>
</html>