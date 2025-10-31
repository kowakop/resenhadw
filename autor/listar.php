<?php
    require_once "../conexao.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Autores</title>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  <style>
        img {
            width: 60px;
            height: 60px;
        }

        div {
            border-style: solid
        }

        .conteiner {
            border-color: blue;
            display: flex;
            flex-wrap: wrap;
        }

        .autor {
            border-color: lightblue;
            padding: 20px;
            width: 220px;
            margin: 20px;
        }

        .autor img {
            width: 60px;
        }
    </style>
</head>
<body>
    <h2>Lista de autors Cadastrados</h2>

    <a href="index.php">Voltar</a> <br>

    <div class="conteiner">
    <?php

        require_once "conexao.php";

        $sql = "SELECT * FROM autor";
        $comando = mysqli_prepare($conexao, $sql);

        mysqli_stmt_execute($comando);

        $resultados = mysqli_stmt_get_result($comando);

        while ($autor = mysqli_fetch_assoc($resultados)) {
            $id_autor = $autor['autor_id'];
            $nome = $autor['autor_nome'];
            $genero = $autor['autor_genero'];
            $ano = $autor['autor_ano'];
            $foto = $autor['autor_foto'];
            
            echo "<div class='autor'>";
            echo "<img src='#'>";
            echo "<p>$id_autor - $nome</p>";
            echo "<p>Gênero: <span>$genero</span></p>";
            echo "<p>Ano: $ano</p>";
            echo "</div>";
        }
        mysqli_stmt_close($comando);    
    ?>
    </div>
</body>
</html>