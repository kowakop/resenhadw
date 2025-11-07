<?php
require_once "../conexao.php";
require_once "../verificar_user.php";

$id = $_GET['id'];

$sqlObra = "SELECT 
    obra_id, 
    obra_nome, 
    obra_data_inicio, 
    obra_data_final, 
    obra_qtd_capitulos,
    obra_qtd_volumes,
    autor_nome,
    obra_foto 
FROM obra
INNER JOIN autor ON obra_autor_id = autor_id
WHERE obra_id = ?";
$comando = mysqli_prepare($conexao, $sqlObra);
mysqli_stmt_bind_param($comando, "i", $id);
mysqli_stmt_execute($comando);

$resultados_obra = mysqli_stmt_get_result($comando);

//favoritos
$sql = "SELECT COUNT(*) AS qtd_favoritos 
           FROM favorito 
           WHERE favorito_id = ? AND favorito_tipo = 're'";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, "i", $id);
mysqli_stmt_execute($comando);
$resultados_fav = mysqli_stmt_get_result($comando);

$qtd_favoritos = mysqli_fetch_assoc($resultados_fav)['qtd_favoritos'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="../index.php?url=listar.php%3Fobjeto%3Dobra">voltar</a>
    <?php

    if ($obra = mysqli_fetch_assoc($resultados_obra)) {

        echo "<div class='obra'>";
        echo "<h1>" . htmlspecialchars($obra['obra_nome']) . "</h1>";
        echo "<p><span>Obra:</span> " . htmlspecialchars($obra['obra_nome']) . "</p>";
        echo "<p><span>Autor da obra:</span> " . htmlspecialchars($obra['autor_nome']) . "</p>";
        echo "<p><span>Data:</span> " . date('d/m/Y H:i', strtotime($obra['obra_data_inicio'])) . "</p>";
        echo "<p><span>Data final:</span> " . nl2br(htmlspecialchars($obra['obra_data_final'])) . "</p>";
        echo "<p><span>Quantidade de capítulos:</span> " . nl2br(htmlspecialchars($obra['obra_qtd_capitulos'])) . "</p>";
        echo "<p><span>Quantidade de volumes:</span> " . nl2br(htmlspecialchars($obra['obra_qtd_volumes'])) . "</p>";
        echo "<p>Favoritos: $qtd_favoritos</p>";

        if ($tipo == "admin") {
            echo "<a href='cadastrar.php?id=$id'>editar</a>";
        }
        echo "</div>";
    } else {
        echo "obra não encontrada.";
    }
    ?>
</body>

</html>