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
</head>
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
    $url = urlencode($url);

    echo '<a href="../index.php?url=' . $url . '" target="_top">voltar</a>';
    ?>
    
<?php
if ($resenha = mysqli_fetch_assoc($resultados_resenha)) {
    echo "<div class='resenha'>";
    echo "<h1>" . htmlspecialchars($resenha['resenha_titulo']) . "</h1>";
    echo "<p><span>Obra:</span> " . htmlspecialchars($resenha['obra_nome']) . "</p>";
    echo "<p><span>Autor da resenha:</span> " . htmlspecialchars($resenha['usuario_nome']) . "</p>";
    echo "<p><span>Data:</span> " . date('d/m/Y H:i', strtotime($resenha['resenha_data'])) . "</p>";
    echo "<p><span>Conteúdo:</span> " . htmlspecialchars($resenha['resenha_conteudo']) . "</p>";
    echo "<p>likes: $qtd_likes</p>";

    $sql = "SELECT * FROM likes WHERE likes_usuario_id = ? AND likes_resenha_id = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ii', $id_user, $id); // $id = id da resenha
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $curtiu = mysqli_fetch_assoc($resultado);

    if (!$curtiu) {
        echo "<a href='../like.php?voltar=$voltar&id=$id' class='botao'>Curtir</a>";
    } else {
        echo "<a href='../like.php?voltar=$voltar&id=$id' class='botao'>Descurtir</a>";
    }


    if ($tipo == "admin") {
        echo "<BR><a href='form_resenha.php?id=$id'>editar</a>
        <br> <a href='../deletar.php?id=$id'>excluir</a>";
    }
    echo "</div>";
} else {
    echo "Resenha não encontrada.";
}
?>
</body>
</html>
