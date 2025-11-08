<?php
require_once "../conexao.php";

if (isset($_GET["filtro"])) {
    $filtro = $_GET["filtro"];
} else {
    $filtro = "alfabetica";
}

if (isset($_GET["ordem"]) && $_GET["ordem"] == "invertida") {
    $ordem = "DESC";
} else {
    $ordem = "ASC";
}

// left join junta dados mesmo se o resenha não tiver obras ou favoritos
// group by agrupa as linhas pelo resenha para o count
// e distinct pra só contar uma vez cada obra ou favorito
// apelidos para identificar os bagui aí
$sql = "
SELECT 
    resenha_id,
    resenha_titulo,
    resenha_data,
    resenha_conteudo,
    usuario_nome,
    obra_nome
FROM resenha
INNER JOIN obra ON resenha_obra_id = obra_id
INNER JOIN usuario ON resenha_usuario_id = usuario_id
GROUP BY resenha_id
";


if ($filtro == "data") {
    $sql .= " ORDER BY resenha_data_nasc $ordem";
} else {
    if ($filtro == "favorito") {
        $sql .= " ORDER BY qtd_favoritos $ordem";
    } else {
        $sql .= " ORDER BY resenha_titulo $ordem";
    }
}

$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de resenhas</title>
    <style>
        .conteiner {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin: 30px 0px;
        }

        .resenha {
            border: 1px solid lightblue;
            padding: 20px;
            width: 220px;
        }

        img {
            width: 60px;
            height: 60px;
        }

        a {
            color: black;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="conteiner" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
        <?php
        while ($resenha = mysqli_fetch_assoc($resultado)) {

            // Formatar data se existir
            if (!empty($resenha["resenha_data"])) {
                $data = date('d/m/Y', strtotime($resenha["resenha_data"]));
            } else {
                $data = "Data não informada";
            }

            $url = "resenha/pagina.php?id=" . $resenha['resenha_id'];
            $url = urlencode($url);

            echo '<a href="../index.php?url=' . $url . '" target="_top"' . '" style="text-decoration: none; color: black;">';
            echo '<div class="resenha" style="border: 1px solid lightblue; padding: 20px; width: 250px; border-radius: 10px;">';
            echo '<h3>' . $resenha['resenha_titulo'] . '</h3>';
            echo '<p><strong>Data:</strong> ' . $data . '</p>';
            echo '<p><strong>Autor da resenha:</strong> ' . $resenha['usuario_nome'] . '</p>';
            echo '<p><strong>Obra:</strong> ' . $resenha['obra_nome'] . '</p>';
            echo '<p>' . nl2br($resenha['resenha_conteudo']) . '</p>';
            echo '</div>';
            echo '</a>';
        }
        ?>
    </div>
</body>


</html>