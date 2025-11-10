<?php
require_once "../conexao.php";
require_once "../verificar_user.php";

if (isset($_GET["filtro"])) {
    $filtro = $_GET["filtro"];
} 

else {
    $filtro = "alfabetica";
}

if (isset($_GET["ordem"]) && $_GET["ordem"] == "invertida") {
    $ordem = "DESC";
} 

else {
    $ordem = "ASC";
}

$sql = "
SELECT 
    usuario_id,
    usuario_nome,
    usuario_data_nasc,
    usuario_email,
    usuario_foto,
    usuario_nick,
    COUNT(DISTINCT resenha_id) AS qtd_resenhas,
    COUNT(DISTINCT favorito_id) AS qtd_favoritos
FROM usuario
LEFT JOIN resenha ON resenha_usuario_id = usuario_id
LEFT JOIN favorito ON favorito_id = usuario_id AND favorito_tipo = 're'
GROUP BY usuario_id
";

if ($filtro == "data") {
    $sql .= " ORDER BY usuario_data_nasc $ordem";
} 

$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resenhistas</title>
    <link rel="stylesheet" href="../listar.css">
</head>
<body>
    <div class="conteiner" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
        <?php
        while ($usuario = mysqli_fetch_assoc($resultado)) {

            // Formatar data se existir
            if (!empty($usuario["usuario_data_nasc"])) {
                $data = date('d/m/Y', strtotime($usuario["usuario_data_nasc"]));
            } 
            else {
                $data = "Data não informada";
            }

            $url = "resenhista/pagina.php?id=" . $usuario['usuario_id'];
            $url = urlencode($url);

            echo '<a href="../index.php?url=' . $url . '" target="_top" class="item-link">';
            echo '  <div class="item-card user-card">';
            echo '      <h3 class="item-title">' . htmlspecialchars($usuario['usuario_nick']) . '</h3>';
            echo '      <p class="item-info"><strong>Quantidade de resenhas publicadas:</strong> ' . $usuario['qtd_resenhas'] . '</p>';
            echo '      <p class="item-info"><strong>' . $usuario['qtd_favoritos'] . ' usuários favoritaram esse resenhista</strong></p>';
            echo '  </div>';
            echo '</a>';
            
        }
        ?>
    </div>
</body>
</html>