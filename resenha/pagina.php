<?php
require_once "../conexao.php";
require_once "../verificar_user.php";

$id = $_GET['id'];
$voltar = 1;

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
$sql = "SELECT COUNT(DISTINCT likes_usuario_id) AS qtd_likes
        FROM likes
        WHERE likes_resenha_id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultados_fav = mysqli_stmt_get_result($stmt);

$qtd_likes = mysqli_fetch_assoc($resultados_fav)['qtd_likes'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resenha</title>
    <link rel="stylesheet" href="../style-paginas.css">
 
<body>
<?php
    $url = "../listar.php?objeto=resenha";
    if(isset($_GET["voltar"])) {
        $voltar = $_GET["voltar"];
        if ($voltar == "feed") {
            $url = './resenha/feed.php';
        } elseif ($voltar == "liked") {
            $url = './resenha/liked.php';
        } else {
            $url = "./listar.php?objeto=resenha";
        }        
    }

echo '<a href="../index.php?url=' . urlencode($url) . '" class="voltar" target="_top">← Voltar</a>';

if ($resenha = mysqli_fetch_assoc($resultados_resenha)) {

    echo '<div class="card">';
    echo '<h1>' . htmlspecialchars($resenha['resenha_titulo']) . '</h1>';
    echo '<p><span>Obra:</span> ' . htmlspecialchars($resenha['obra_nome']) . '</p>';
    echo '<p><span>Autor da resenha:</span> ' . htmlspecialchars($resenha['usuario_nome']) . '</p>';
    echo '<p><span>Data:</span> ' . date('d/m/Y H:i', strtotime($resenha['resenha_data'])) . '</p>';
    echo '<div class="conteudo-caixa">';
    echo nl2br(htmlspecialchars($resenha['resenha_conteudo']));
    echo '</div>';
    echo '<p>❤️ Likes: ' . $qtd_likes . '</p>';

    // Verificar curtida
    $sql = "SELECT * FROM likes WHERE likes_usuario_id = ? AND likes_resenha_id = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ii', $id_user, $id);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);
    $curtiu = mysqli_fetch_assoc($resultado);

    if (!$curtiu) {
        echo '<a href="../like.php?voltar=' . $voltar . '&id=' . $id . '" class="botao">Curtir</a>';
    } else {
        echo '<a href="../like.php?voltar=' . $voltar . '&id=' . $id . '" class="botao">Descurtir</a>';
    }

    // Links do admin
    if ($tipo == "admin") {
        echo '<div class="admin-links">';
        echo '<a href="form_resenha.php?id=' . $id . '">Editar</a> | ';
        echo '<a href="../deletar.php?id=' . $id . '">Excluir</a>';
        echo '</div>';
    }

    echo '</div>';

} else {
    echo '<p>Resenha não encontrada.</p>';
}
?>
</body>
</html>


