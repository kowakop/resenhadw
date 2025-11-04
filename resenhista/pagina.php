<?php
    require_once "../conexao.php";
    require_once "../verificar_user.php";

    $id = $_GET['id'];

$sqlUser = "SELECT usuario_id, usuario_nome, usuario_data_nasc, usuario_email, usuario_foto, usuario_nick
             FROM usuario 
             WHERE usuario_id = ?";
$stmt = mysqli_prepare($conexao, $sqlUser);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$resultados_user = mysqli_stmt_get_result($stmt);

//favoritos
$sql = "SELECT COUNT(*) AS qtd_favoritos 
           FROM favorito 
           WHERE favorito_id = ? AND favorito_tipo = 're'";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultados_fav = mysqli_stmt_get_result($stmt);

$qtd_favoritos = mysqli_fetch_assoc($resultados_fav)['qtd_favoritos'];

//resenhas
$sql = "SELECT COUNT(resenha_id) AS qtd_resenhas 
               FROM resenha 
               INNER JOIN obra o ON resenha_obra_id = obra_id
               WHERE obra_autor_id = ?
               group by resenha_id";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultados_resenhas = mysqli_stmt_get_result($stmt);

$qtd_resenhas = mysqli_fetch_assoc($resultados_resenhas)['qtd_resenhas'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Resenhista</title>
</head>
<body>
    <a href="../listar.php?objeto=resenhista">voltar</a>
    <?php
    if ($usuario = mysqli_fetch_assoc($resultados_user)) {
    $foto = $usuario['usuario_foto'];
    $arquivo = "../fotos/$foto";

        if (!file_exists($arquivo) || $foto == null) {
            $arquivo = "../fotos/padrao-user.jpeg";
        }
        echo "<div class='Usuário'>";
        echo "<img src='$arquivo'>";
        echo "<h1>" . htmlspecialchars($usuario['usuario_nome']) . "</h1>";
        echo "<p><span>Data de nascimento:</span> " . date('d/m/Y', strtotime($usuario['usuario_data_nasc'])) . "</span></p>";
        echo "<p>Favoritos: $qtd_favoritos</p>";
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