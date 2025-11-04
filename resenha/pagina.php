<?php
require_once "../conexao.php";
require_once "../verificar_user.php";

$id = $_GET['id'];

// Dados da resenha
$sqlResenha = "SELECT resenha_id, resenha_titulo, resenha_data, resenha_conteudo, 
                      usuario_nome, obra_nome
               FROM resenha r
               INNER JOIN usuario ON resenha_usuario_id = usuario_id
               INNER JOIN obra ON resenha_obra_id = obra_id
               WHERE r.resenha_id = ?";
$stmt = mysqli_prepare($conexao, $sqlResenha);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$resultados_resenha = mysqli_stmt_get_result($stmt);

// favoritos
$sql = "SELECT COUNT(*) AS qtd_favoritos 
        FROM favorito 
        WHERE favorito_id = ? AND favorito_tipo = 're'";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultados_fav = mysqli_stmt_get_result($stmt);

$qtd_favoritos = mysqli_fetch_assoc($resultados_fav)['qtd_favoritos'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resenha</title>
</head>
<body>
<?php
if ($resenha = mysqli_fetch_assoc($resultados_resenha)) {
    echo "<div class='resenha'>";
    echo "<h1>" . htmlspecialchars($resenha['resenha_titulo']) . "</h1>";
    echo "<p><span>Obra:</span> " . htmlspecialchars($resenha['obra_nome']) . "</p>";
    echo "<p><span>Autor da resenha:</span> " . htmlspecialchars($resenha['usuario_nome']) . "</p>";
    echo "<p><span>Data:</span> " . date('d/m/Y H:i', strtotime($resenha['resenha_data'])) . "</p>";
    echo "<p><span>Conteúdo:</span> " . nl2br(htmlspecialchars($resenha['resenha_conteudo'])) . "</p>";
    echo "<p>Favoritos: $qtd_favoritos</p>";

    if ($tipo == "admin") {
        echo "<a href='form_resenha.php?id=$id'>editar</a>";
    }
    echo "</div>";
} else {
    echo "Resenha não encontrada.";
}
?>
</body>
</html>
