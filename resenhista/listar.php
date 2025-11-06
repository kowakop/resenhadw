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
    COUNT(DISTINCT obra_id) AS qtd_obras,
    COUNT(DISTINCT favorito_usuario_id) AS qtd_favoritos
FROM usuario
LEFT JOIN obra ON obra_autor_id = usuario_id
LEFT JOIN favorito ON favorito_usuario_id = usuario_id AND favorito_tipo = 're'
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

            echo '<a href="pagina.php?id=' . $usuario['usuario_id'] . '" target="principal" style="text-decoration: none; color: black;">';
            echo '<div class="resenha" style="border: 1px solid lightblue; padding: 20px; width: 250px; border-radius: 10px;">';
            echo '<h3>' . $usuario['usuario_nick'] . '</h3>';
            echo '<p><strong>Quantidade de resenhas publicadas:</strong> ' . $usuario['qtd_obras'] . '</p>';
            echo '<p><strong>' . $usuario['qtd_favoritos'] . ' usuários favoritaram esse resenhista </p></strong>';
            //echo '<p>' . nl2br($resenha['resenha_conteudo']) . '</p>';
            echo '</div>';
            echo '</a>';
        }
        ?>
    </div>
</body>
</html>