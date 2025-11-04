<?php
require_once "../conexao.php";
require_once "../verificar_user.php";

$id = $_GET['id'];

$sqlAutor = "SELECT autor_id, autor_nome, autor_data_nasc, autor_data_morte, autor_foto 
             FROM autor 
             WHERE autor_id = ?";
$stmt = mysqli_prepare($conexao, $sqlAutor);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$resultados_autor = mysqli_stmt_get_result($stmt);

//favoritos
$sql = "SELECT COUNT(*) AS qtd_favoritos 
           FROM favorito 
           WHERE favorito_id = ? AND favorito_tipo = 'au'";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultados_fav = mysqli_stmt_get_result($stmt);

$qtd_favoritos = mysqli_fetch_assoc($resultados_fav)['qtd_favoritos'];

//obras
$sql = "SELECT COUNT(*) AS qtd_obras 
            FROM obra 
            WHERE obra_autor_id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultados_obras = mysqli_stmt_get_result($stmt);

$qtd_obras = mysqli_fetch_assoc($resultados_obras)['qtd_obras'];

//resenhas sobre suas obras
$sql = "SELECT COUNT(*) AS qtd_resenhas 
               FROM resenha r
               INNER JOIN obra o ON r.resenha_obra_id = o.obra_id
               WHERE o.obra_autor_id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultados_resenhas = mysqli_stmt_get_result($stmt);

$qtd_resenhas = mysqli_fetch_assoc($resultados_resenhas)['qtd_resenhas'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    if ($autor = mysqli_fetch_assoc($resultados_autor)) {
        $morte = $autor['autor_data_morte'];
        $foto = $autor['autor_foto'];



        if ($morte != null) {
            $morte = "Morte:</span> " . date('d/m/Y', strtotime($morte));
        } else {
            $morte = "Vivo</span>";
        }
        $arquivo = "../fotos/$foto";

        if (!file_exists($arquivo) || $foto == null) {
            $arquivo = "../fotos/padrao-autor.png";
        }


        echo "<div class='autor'>";
        echo "<img src='$arquivo'>";
        echo "<h1>" . htmlspecialchars($autor['autor_nome']) . "</h1>";
        echo "<p><span>Data de nascimento:</span> " . date('d/m/Y', strtotime($autor['autor_data_nasc'])) . "</span></p>";
        echo "<p><span>" . $morte . "</p>";
        echo "<p>Favoritos: $qtd_favoritos</p>";
        echo "<p>Obras: $qtd_obras</p>";
        echo "<p>Resenhas: $qtd_resenhas</p>";
        if ($tipo == "admin") {
            echo "<a href='cadastrar.php?id=$id'>editar</a>";
        }
        echo "</div>";
    } else {
        echo "Autor não encontrado.";
    }
    ?>
</body>

</html>