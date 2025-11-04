<?php
require_once "../conexao.php";
require_once "../verificar_user.php";

$id = $_GET['id'];

$sqlResenha = "SELECT 
    resenha_id, 
    resenha_titulo, 
    resenha_data, 
    resenha_conteudo, 
    resenha_usuario_id, 
    resenha_obra_id
FROM resenha 
WHERE resenha_id = ?";
$comando = mysqli_prepare($conexao, $sqlResenha);
mysqli_stmt_bind_param($comando, "i", $id);
mysqli_stmt_execute($comando);

$resultados_resenha = mysqli_stmt_get_result($comando);

//favoritos
$sql = "SELECT COUNT(*) AS qtd_favoritos 
           FROM favorito 
           WHERE favorito_id = ? AND favorito_tipo = 're'";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, "i", $id);
mysqli_stmt_execute($comando);
$resultados_fav = mysqli_stmt_get_result($comando);

$qtd_favoritos = mysqli_fetch_assoc($resultados_fav)['qtd_favoritos'];

//obra relacionada
$sql = "SELECT obra_nome 
           FROM obra 
           WHERE obra_id = (SELECT resenha_obra_id FROM resenha WHERE resenha_id = ?)";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, "i", $id);
mysqli_stmt_execute($comando);
$resultados_obra = mysqli_stmt_get_result($comando);

$obra_nome = mysqli_fetch_assoc($resultados_obra)['obra_nome'];

//usuario que fez a resenha
$sql = "SELECT usuario_nome 
           FROM usuario 
           WHERE usuario_id = (SELECT resenha_usuario_id FROM resenha WHERE resenha_id = ?)";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, "i", $id);
mysqli_stmt_execute($comando);
$resultados_user = mysqli_stmt_get_result($comando);

$usuario_nome = mysqli_fetch_assoc($resultados_user)['usuario_nome'];

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

    if ($resenha = mysqli_fetch_assoc($resultados_resenha)) {

        echo "<div class='resenha'>";
        echo "<h1>" . htmlspecialchars($resenha['resenha_titulo']) . "</h1>";
        echo "<p><span>Obra:</span> " . htmlspecialchars($obra_nome) . "</p>";
        echo "<p><span>Autor da resenha:</span> " . htmlspecialchars($usuario_nome) . "</p>";
        echo "<p><span>Data:</span> " . date('d/m/Y H:i', strtotime($resenha['resenha_data'])) . "</p>";
        echo "<p><span>Conteúdo:</span> " . nl2br(htmlspecialchars($resenha['resenha_conteudo'])) . "</p>";
        echo "<p>Favoritos: $qtd_favoritos</p>";
        if ($tipo == "admin") {
            echo "<a href='cadastrar.php?id=$id'>editar</a>";
        }
        echo "</div>";
    } else {
        echo "Resenha não encontrada.";
    }
    ?>
</body>

</html>
